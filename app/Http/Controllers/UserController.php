<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\User;
use File;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage User'))
        {
            $data = User::orderBy('id','DESC')->paginate(5);
            return view('users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        if(\Auth::user()->can('Create User'))
        {
            $validator        = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'email' => 'required|unique:users',
                                   'password' => 'required|min:6',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $role_r = Role::findByName( $request->roles);

            // dd(Auth::user()->id);
            $user   = User::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'confirm_password' => 'required|same:password',
                    'type' => $role_r->name,
                    'created_by' => \Auth::user()->id,
                ]
            );

            $user->assignRole($role_r);
            if($user)
            {

                $user->type     = $role_r->name;
                $user->password = $request['password'];
                // dd($user->password);
                try
                {
                    Mail::to($user->email)->send(new Email($user));

                }
                catch(\Exception $e)
                {
                    dd($e);
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('users.index')->with('success', __('User successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }
            return redirect()->route('users.index')->with('success', __('User successfully created.'));
        }

    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'password' => 'same:confirm-password',
        //     'roles' => 'required'
        // ]);

        $input = $request->all();


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function profile()
    {
        $userDetail = \Auth::user();
        // dd($userDetail);

        return view('users.profile')->with('userDetail', $userDetail);
    }

    public function editprofile(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = User::findOrFail($userDetail['id']);
        $validator = \Validator::make(
            $request->all(), [
                               'name' => 'required|max:120',
                               'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                               'profile' => 'image|mimes:jpeg,png,jpg,svg|max:3072',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        if($request->hasFile('profile'))
        {

            $filenameWithExt = $request->file('profile')->getClientOriginalName();

            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $dir             = storage_path('app/uploads/avatar/');
            $image_path      = $dir . $userDetail['avatar'];
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);

        }

        if(!empty($request->profile))
        {
            $user['avatar'] = $fileNameToStore;
            // dd($user);

        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
            // dd($user);

        $user->save();



        return redirect()->back()->with(
            'success', 'Profile successfully updated.'
        );
    }


    public function updatePassword(Request $request)
    {
        if(\Auth::Check())
        {
            $request->validate(
                [
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if(Hash::check($request_data['current_password'], $current_password))
            {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['new_password']);;
                $obj_user->save();

                return redirect()->route('profile', $objUser->id)->with('success', __('Password successfully updated.'));
            }
            else
            {
                return redirect()->route('profile', $objUser->id)->with('error', __('Please enter correct current password.'));
            }
        }
        else
        {
            return redirect()->route('profile', \Auth::user()->id)->with('error', __('Something is wrong.'));
        }
    }



    public function lastLogin()
    {
        $users = User::where('created_by', \Auth::user()->creatorId())->get();

        return view('users.lastLogin', compact('users'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->can('Delete User'))
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User successfully deleted.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
