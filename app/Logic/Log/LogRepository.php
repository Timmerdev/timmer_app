<?php
namespace App\Logic\Log;

use App\Models\Log;
use App\Models\Password;
use Hash, Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class LogRepository {
    
    public function __construct( Guard $auth)
    {
        $this->auth = $auth;
    }
    public function createLog( $data )
    {

        $log = new Log;
        $log->log_name            = $data['log_name'];
        $log->log_description       = $data['log_description'];
        $log->duration = $data['duration'];
        $log->status = $data['status'];
        $log->retrieved_from = $data['retrieved_from'];
        $log->is_group_log = $data['is_group_log'];
        $log->priority         = $data['priority'];
        $log->list_id       = $data['list_id'];
        $log->user_id       =    $this->auth->id();
        $log->save();


    }
    public function getAllLogs()
    {
         $logs = Log::all();
         return $logs;
    }
    public function getSpecificLog($id)
    {
        $specificLogs = Log::where('id', '=', $id)->first();
          return $specificLogs;
    }
    public function getSpecificLogs($id)
    {
        $specificLogs = Log::where('id', '=', $id)
                            ->where('user_id',$this->auth->id())
                            ->get();
          return $specificLogs;
    }
    public function getSpecificLogsByList($list_id)
    {
        $specificLogs = Log::where('list_id', $list_id)
                            ->where('user_id',$this->auth->id())
                            ->get();
         return $specificLogs;   
    }


}