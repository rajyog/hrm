<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobstage extends Model
{
    public function applications($filter)
    {
        $application = Jobapplication::where('created_by', \Auth::user()->creatorId())->where('is_archive', 0)->where('stage', $this->id);
        $application->where('created_at', '>=', $filter['start_date']);
        $application->where('created_at', '<=', $filter['end_date']);

        if(!empty($filter['job']))
        {
            $application->where('job', $filter['job']);
        }

        $application = $application->orderBy('order')->get();

        return $application;
    }
}
