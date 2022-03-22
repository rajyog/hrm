<?php

namespace App\Http\Controllers;

use App\Jobcategory;
use Illuminate\Http\Request;

class JobcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Job Category'))
        {
            $categories = JobCategory::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('jobCategory.index', compact('categories'));
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
        if(\Auth::user()->can('Manage Job Category'))
        {

            return view('jobCategory.create ');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
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
        if(\Auth::user()->can('Create Job Category'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobCategory             = new JobCategory();
            $jobCategory->title      = $request->title;
            $jobCategory->created_by = \Auth::user()->creatorId();
            $jobCategory->save();

            return redirect()->back()->with('success', __('Job category  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Jobcategory $jobcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobcategory $jobcategory)
    {
        return view('jobCategory.edit', compact('jobcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobcategory $jobcategory)
    {
        // dd($jobcategory);
        if(\Auth::user()->can('Edit Job Category'))
        {

            $jobcategory->title = $request->title;
            $jobcategory->save();

            return redirect()->back()->with('success', __('Job category  successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobcategory)
    {
        if(\Auth::user()->can('Delete Job Category'))
        {
            if($jobcategory->created_by == \Auth::user()->creatorId())
            {
                $jobcategory->delete();

                return redirect()->back()->with('success', __('Job category successfully deleted.'));
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
