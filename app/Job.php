<?php

namespace App;
use App\Jobcategory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public static $status = [
        'active' => 'Active',
        'in_active' => 'In Active',
    ];

    public function questions()
    {
        $ids = explode(',', $this->custom_question);

        return CustomQuestion::whereIn('id', $ids)->get();

    }
    public function createdBy()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function categories()
    {
        return $this->hasOne('App\Jobcategory', 'id', 'category');
    }
}
