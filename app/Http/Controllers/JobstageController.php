<?php

namespace App\Http\Controllers;

use App\Jobstage;
use Illuminate\Http\Request;

class JobstageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Job Stage'))
        {
            $stages = JobStage::where('created_by', '=', \Auth::user()->creatorId())->orderBy('order', 'asc')->get();

            return view('jobStage.index', compact('stages'));
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
        if(\Auth::user()->can('Create Job Stage'))
        {

            return view('jobStage.create');
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
        if(\Auth::user()->can('Create Job Stage'))
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

            $jobStage             = new JobStage();
            $jobStage->title      = $request->title;
            $jobStage->created_by = \Auth::user()->creatorId();
            $jobStage->save();

            return redirect()->back()->with('success', __('Job stage  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobstage  $jobstage
     * @return \Illuminate\Http\Response
     */
    public function show(Jobstage $jobstage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobstage  $jobstage
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobstage $jobstage)
    {
        // dd($jobstage);
        return view('jobStage.edit', compact('jobstage'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobstage  $jobstage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobstage $jobstage)
    {
        if(\Auth::user()->can('Edit Job Stage'))
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


            $jobstage->title      = $request->title;
            $jobstage->created_by = \Auth::user()->creatorId();
            $jobstage->save();

            return redirect()->back()->with('success', __('Job stage  successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jobstage  $jobstage
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobStage $jobStage)
    {
        if(\Auth::user()->can('Delete Job Stage'))
        {
            if($jobStage->created_by == \Auth::user()->creatorId())
            {
                $jobStage->delete();

                return redirect()->back()->with('success', __('Job stage successfully deleted.'));
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

    public function order(Request $request)
    {
        $post = $request->all();
        foreach($post['order'] as $key => $item)
        {
            $stage        = JobStage::where('id', '=', $item)->first();
            $stage->order = $key;
            $stage->save();
        }
    }
}
