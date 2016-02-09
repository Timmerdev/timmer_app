<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logList extends Model
{
      protected $table = 'list';

      public function user()
      {
      	return $this->belongsTo('App\Models\User');
      }
      public function log()
      {
      	return $this->hasMany('App\Models\Logs');
      }
}
