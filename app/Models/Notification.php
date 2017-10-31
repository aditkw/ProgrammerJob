<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['subject' ,'user_id'];
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function job_request()
    {
      return $this->hasManyThrough('App\Models\Job_Request', 'App\Models\User');
    }
}
