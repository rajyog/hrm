<?php

namespace App\Http\Controllers;

use App\CustomQuestion;
use App\Job;
use App\Jobapplication;
use App\JobApplicationNote;
use App\Jobstage;
use Illuminate\Support\Facades\Crypt;



use Illuminate\Http\Request;

class JobapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Job Application'))
        {
            $stages = JobStage::where('created_by', '=', \Auth::user()->creatorId())->orderBy('order', 'asc')->get();

            $jobs = Job::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $jobs->prepend('All', '');

            if(isset($request->start_date) && !empty($request->start_date))
            {
                $filter['start_date'] = $request->start_date;
            }
            else
            {
                $filter['start_date'] = date("Y-m-d", strtotime("-1 month"));
            }

            if(isset($request->end_date) && !empty($request->end_date))
            {
                $filter['end_date'] = $request->end_date;
            }
            else
            {
                $filter['end_date'] = date("Y-m-d H:i:s", strtotime("+1 hours"));
            }

            if(isset($request->job) && !empty($request->job))
            {
                $filter['job'] = $request->job;
            }
            else
            {
                $filter['job'] = '';
            }


            return view('jobApplication.index', compact('stages', 'jobs', 'filter'));
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
        $jobs = Job::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
        $jobs->prepend('--', '');

        $questions = CustomQuestion::where('created_by', \Auth::user()->creatorId())->get();

        return view('jobApplication.create', compact('jobs', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {

            if(\Auth::user()->can('Create Job Application'))
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'job' => 'required',
                                       'name' => 'required',
                                       'email' => 'required',
                                       'phone' => 'required',
                                       'profile' => 'mimes:jpeg,png,jpg,gif,svg|max:20480',
                                       'resume' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                if(!empty($request->profile))
                {
                    $filenameWithExt = $request->file('profile')->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('profile')->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                    $dir        = storage_path('uploads/job/profile');
                    $image_path = $dir . $filenameWithExt;

                    if(\File::exists($image_path))
                    {
                        \File::delete($image_path);
                    }
                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path = $request->file('profile')->storeAs('uploads/job/profile/', $fileNameToStore);
                }

                if(!empty($request->resume))
                {
                    $filenameWithExt1 = $request->file('resume')->getClientOriginalName();
                    $filename1        = pathinfo($filenameWithExt1, PATHINFO_FILENAME);
                    $extension1       = $request->file('resume')->getClientOriginalExtension();
                    $fileNameToStore1 = $filename1 . '_' . time() . '.' . $extension1;

                    $dir        = storage_path('uploads/job/resume');
                    $image_path = $dir . $filenameWithExt1;

                    if(\File::exists($image_path))
                    {
                        \File::delete($image_path);
                    }
                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path = $request->file('resume')->storeAs('uploads/job/resume/', $fileNameToStore1);
                }

                $job                  = new JobApplication();
                $job->job             = $request->job;
                $job->name            = $request->name;
                $job->email           = $request->email;
                $job->phone           = $request->phone;
                $job->profile         = !empty($request->profile) ? $fileNameToStore : '';
                $job->resume          = !empty($request->resume) ? $fileNameToStore1 : '';
                $job->cover_letter    = $request->cover_letter;
                $job->dob             = $request->dob;
                $job->gender          = $request->gender;
                $job->country         = $request->country;
                $job->state           = $request->state;
                $job->city            = $request->city;
                $job->custom_question = json_encode($request->question);
                $job->created_by      = \Auth::user()->creatorId();
                $job->save();

                return redirect()->route('job-application.index')->with('success', __('Job application successfully created.'));
            }
            else
            {
                return redirect()->route('job-application.index')->with('error', __('Permission denied.'));
            }
        }
    }

    public function order(Request $request)
    {
        if(\Auth::user()->can('Move Job Application'))
        {
            $post = $request->all();
            foreach($post['order'] as $key => $item)
            {
                $application        = JobApplication::where('id', '=', $item)->first();
                $application->order = $key;
                $application->stage = $post['stage_id'];
                $application->save();
            }
        }
        else
        {
            return redirect()->route('job-application.index')->with('error', __('Permission denied.'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function show($ids)
    {

        if(\Auth::user()->can('Show Job Application'))
        {
            $id             = Crypt::decrypt($ids);
            $jobApplication = JobApplication::find($id);

            $stages = JobStage::where('created_by', \Auth::user()->creatorId())->get();


            return view('jobApplication.show', compact('jobApplication','stages'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobapplication $jobapplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobapplication $jobapplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobapplication $jobapplication)
    {
        //
    }
}
