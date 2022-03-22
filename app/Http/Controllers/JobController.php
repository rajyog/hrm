<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobcategory;
use App\CustomQuestion;
use App\Branch;
use Illuminate\Http\Request;

class JobController extends Controller
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
            $jobs = Job::where('created_by', '=', \Auth::user()->creatorId())->get();

            $data['total']     = Job::where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['active']    = Job::where('status', 'active')->where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['in_active'] = Job::where('status', 'in_active')->where('created_by', '=', \Auth::user()->creatorId())->count();

            return view('job.index', compact('jobs', 'data'));
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
        $categories = JobCategory::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
        $categories->prepend('All', '');

        $branches = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $branches->prepend('All', 0);

        $status = Job::$status;

        $customQuestion = CustomQuestion::where('created_by', \Auth::user()->creatorId())->get();

        return view('job.create', compact('categories','status' ,'branches','customQuestion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Job'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'branch' => 'required',
                                   'category' => 'required',
                                   'skill' => 'required',
                                   'position' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'description' => 'required',
                                   'requirement' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $job                  = new Job();
            $job->title           = $request->title;
            $job->branch          = $request->branch;
            $job->category        = $request->category;
            $job->skill           = $request->skill;
            $job->position        = $request->position;
            $job->status          = $request->status;
            $job->start_date      = $request->start_date;
            $job->end_date        = $request->end_date;
            $job->description     = $request->description;
            $job->requirement     = $request->requirement;
            $job->code            = uniqid();
            $job->applicant       = !empty($request->applicant) ? implode(',', $request->applicant) : '';
            $job->visibility      = !empty($request->visibility) ? implode(',', $request->visibility) : '';
            $job->custom_question = !empty($request->custom_question) ? implode(',', $request->custom_question) : '';
            $job->created_by      = \Auth::user()->creatorId();
            $job->save();

            return redirect()->route('job.index')->with('success', __('Job  successfully created.'));
        }
        else
        {
            return redirect()->route('job.index')->with('error', __('Permission denied.'));
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $status          = Job::$status;
        $job->applicant  = !empty($job->applicant) ? explode(',', $job->applicant) : '';
        $job->visibility = !empty($job->visibility) ? explode(',', $job->visibility) : '';
        $job->skill      = !empty($job->skill) ? explode(',', $job->skill) : '';

        return view('job.show', compact('status', 'job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function jobRequirement($code, $lang)
    {
        $job = Job::where('code', $code)->first();
        if($job->status == 'in_active')
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

        \Session::put('lang', $lang);

        \App::setLocale($lang);

        $companySettings['title_text']      = \DB::table('settings')->where('created_by', $job->created_by)->where('name', 'title_text')->first();
        $companySettings['footer_text']     = \DB::table('settings')->where('created_by', $job->created_by)->where('name', 'footer_text')->first();
        $companySettings['company_favicon'] = \DB::table('settings')->where('created_by', $job->created_by)->where('name', 'company_favicon')->first();
        $companySettings['company_logo']    = \DB::table('settings')->where('created_by', $job->created_by)->where('name', 'company_logo')->first();
        $languages                          = \Utility::languages();

        $currantLang = \Session::get('lang');
        if(empty($currantLang))
        {
            $currantLang = !empty($job->createdBy) ? $job->createdBy->lang : 'en';
        }


        return view('job.requirement', compact('companySettings', 'job', 'languages', 'currantLang'));
    }
}
