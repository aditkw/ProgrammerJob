<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function job_requests()
    {
      return $this->hasMany('App\Models\Job_Request');
    }
}
