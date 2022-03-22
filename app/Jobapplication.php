<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobapplication extends Model
{
    public function jobs()
    {
        return $this->hasOne('App\Job', 'id', 'job');
    }
}
