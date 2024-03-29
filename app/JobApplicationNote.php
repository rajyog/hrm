<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicationNote extends Model
{
    public function noteCreated()
    {
        return $this->hasOne('App\User', 'id', 'note_created');
    }
}
