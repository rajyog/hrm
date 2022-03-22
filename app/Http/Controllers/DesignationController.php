<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Department;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Designation'))
        {
            $designations = Designation::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('designation.index', compact('designations'));
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
        if(\Auth::user()->can('Create Designation'))
        {
            $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get();
            $departments = $departments->pluck('name', 'id');

            return view('designation.create', compact('departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Designation'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'department_id' => 'required',
                                   'name' => 'required|max:20',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $designation                = new Designation();
            $designation->department_id = $request->department_id;
            $designation->name          = $request->name;
            $designation->created_by    = \Auth::user()->creatorId();

            $designation->save();

            return redirect()->route('designation.index')->with('success', __('Designation  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        if(\Auth::user()->can('Edit Designation'))
        {
            if($designation->created_by == \Auth::user()->creatorId())
            {

                $departments = Department::where('id', $designation->department_id)->first();
                $departments = $departments->pluck('name', 'id');

                return view('designation.edit', compact('designation', 'departments'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        if(\Auth::user()->can('Edit Designation'))
        {
            if($designation->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'department_id' => 'required',
                                       'name' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $designation->name          = $request->name;
                $designation->department_id = $request->department_id;
                $designation->save();

                return redirect()->route('designation.index')->with('success', __('Designation  successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if(\Auth::user()->can('Delete Designation'))
        {
            if($designation->created_by == \Auth::user()->creatorId())
            {
                $designation->delete();

                return redirect()->route('designation.index')->with('success', __('Designation successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
