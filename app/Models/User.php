<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
      return $this->belongsToMany('App\Models\Role', 'role_users');
    }

    public function detail_user()
    {
      return $this->hasOne('App\Models\Detail_User');
    }

    public function job_request()
    {
      return $this->hasOne('App\Models\Job_Request');
    }

    public function notifications()
    {
      return $this->hasMany('App\Models\Notification');
    }
}
