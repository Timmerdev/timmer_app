<?php
namespace App\Logic\Lists;

use Illuminate\Contracts\Auth\Guard;
use App\Models\logList;
use Auth;

class ListRepository {

   
	public function __construct( Guard $auth)
	{
		$this->auth = $auth;
	}
    public function createList( $data )
    {
    	
        $logList = new logList;
        $id = $this->auth->id();
        $logList->user_id = $id;
        $logList->list_date = $data;

       	$logList->save();

    }
    public function getLists()
    {
        $logList = logList::all();
        return $logList;
    }
    public function getSpecificList($date)
    {
        $dateCheck = logList::where('list_date', '=', $date)
                            ->where('user_id',$this->auth->id())
                            ->first();
            if(empty($dateCheck))
            {
                $dateCheck = null;
            }
          return $dateCheck;
    }


}