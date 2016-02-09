<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $table = 'log';

	protected $fillable = ['log_name','description','duration','status','retrieved_from','is_group_log','priority'];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
	public function logList()
	{
		return $this->belongsTo('App\Models\logList');
	}
}
