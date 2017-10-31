<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_Request extends Model
{
    protected $table   =  'job_requests';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function job()
    {
      return $this->belongsTo('App\Models\Job');
    }
}
