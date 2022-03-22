<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function branch(){
        return $this->hasOne('App\Branch','id','branch_id');
    }
}
