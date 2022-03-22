<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Role'))
        {
            $roles = Role::all();

            return view('roles.index')->with('roles', $roles);
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
        // $roles = Role::orderBy('id','ASC')->paginate(5);
        // return view('roles.index',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Role'))
        {
            $user = \Auth::user();
            if($user->type == 'super admin' || $user->type == 'company')
            {
                $permissions = Permission::all()->pluck('name', 'id')->toArray();
            }
            else
            {
                $permissions = new Collection();
                foreach($user->roles as $role)
                {
                    $permissions = $permissions->merge($role->permissions);
                }
                $permissions = $permissions->pluck('name', 'id')->toArray();

            }

            return view('roles.create', ['permissions' => $permissions]);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Role'))
        {
            $this->validate(
                $request, [
                            'name' => 'required|max:100|unique:roles,name',
                            'permissions' => 'required',
                        ]
            );

            $name             = $request['name'];
            $role             = new Role();
            $role->name       = $name;
            $permissions      = $request['permissions'];
            $role->save();

            foreach($permissions as $permission)
            {
                $p    = Permission::where('id', '=', $permission)->firstOrFail();
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($p);
            }

            return redirect()->route('roles.index')->with('success', __('Role successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
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
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        if(\Auth::user()->can('Edit Role'))
        {

            $user = \Auth::user();
            if($user->type == 'super admin' || $user->type == 'company')
            {
                $permissions = Permission::all()->pluck('name', 'id')->toArray();

            }
            else
            {
                $permissions = new Collection();
                foreach($user->roles as $role1)
                {
                    $permissions = $permissions->merge($role1->permissions);
                }
                $permissions = $permissions->pluck('name', 'id')->toArray();
            }


            return view('roles.edit', compact('role', 'permissions'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */public function update(Request $request, Role $role)
    {
        if(\Auth::user()->can('Edit Role'))
        {
            if($role->name == 'employee')
            {
                $this->validate(
                    $request, [
                                'permissions' => 'required',
                            ]
                );
            }
            else
            {
                $this->validate(
                    $request, [
                                'name' => 'required|max:100|unique:roles,name,' . $role['id'] . ',id,created_by,' . \Auth::user()->creatorId(),
                                'permissions' => 'required',
                            ]
                );
            }

            $input       = $request->except(['permissions']);
            $permissions = $request['permissions'];
            $role->fill($input)->save();

            $p_all = Permission::all();

            foreach($p_all as $p)
            {
                $role->revokePermissionTo($p);
            }

            foreach($permissions as $permission)
            {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);

            }


            return redirect()->route('roles.index')->with('success', __('Role successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success',__('Role deleted successfully'));
    }
}
