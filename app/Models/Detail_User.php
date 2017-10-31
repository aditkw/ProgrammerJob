<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_User extends Model
{
    protected $table = 'detail_users';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
}
