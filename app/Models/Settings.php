<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
	protected $table = 'user_settings';

    protected $fillable = ['list_view', 'lock_app', 'google_account', 'facebook_account'];
	
    public function user()
      {
      	return $this->belongsTo('App\Models\User');
      }
}
