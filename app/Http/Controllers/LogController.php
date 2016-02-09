<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Log\LogRepository;
use App\Logic\Lists\ListRepository;
use Input, Auth;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\ObjectToArray;
use App\Traits\CurrentDate;

class LogController extends Controller
{
    use ObjectToArray;
    use CurrentDate;
    protected $logRepository;
    protected $listRepository;

    public function __construct(LogRepository $logRepository, ListRepository $listRepository)
    {

        $this->logRepository = $logRepository;
        $this->listRepository = $listRepository;
        Carbon::setTestNow();
    }

    public function index()
    {
        //getting the date today, and finding the corresponding list to it.
        $dateToday = $this->getCurrentDate();
        $dateObjectYesterday = Carbon::yesterday();
        $dateObjectTomorrow = Carbon::tomorrow();

        $dateArrayYesterday = $this->dateObjectToArray($dateObjectYesterday);
        $dateArrayTomorrow = $this->dateObjectToArray($dateObjectTomorrow);
        $dayBefore = $dateArrayYesterday['currentDay'] ."/". $dateArrayYesterday['currentMonth']."/".$dateArrayYesterday['currentYear'];
        $dayAfter = $dateArrayTomorrow['currentDay'] ."/". $dateArrayTomorrow['currentMonth']."/".$dateArrayTomorrow['currentYear'];
        
        //checks if a lists exists for a corresponnding date. If there is no list, returns a null value.
        $currentList = $this->listRepository->getSpecificList($dateToday['currentDay'] ."/". $dateToday['currentMonth']."/".$dateToday['currentYear']);
        if(!(empty($currentList))){
        $currentListID = $currentList->id;
        $logsData = $this->logRepository->getSpecificLogsByList($currentListID);
            
                if($logsData->isEmpty())
                {
                    $logsData = null;
                }
           
        }
        else{
        $logsData = null;
        }
         $data =[
            'thisDay'=> "class = active ",
            'thisWeek'=>'',
            'thisMonth' =>'',
            'id' => 'thisDay' ];
        $dayName = $dateToday['currentDayName'];
        $monthName = $dateToday['currentMonthName'];
        $day = $dateToday['currentDay'];
        $year = $dateToday['currentYear'];
        return view('main-tabs.thisDay',$data)
            ->with('logsData',$logsData)
            ->with('dayBefore',$dayBefore)
            ->with('dayAfter',$dayAfter)
            ->with('dayName',$dayName)
            ->with('monthName',$monthName)
            ->with('day',$day)
            ->with('year',$year);
    }
    public function showLogsBySpecificDate($day, $month, $year)
    {
        $date = $day."/".$month."/".$year;
        $today = $this->getCurrentDate();
        $currentDate = $today['currentDay'] ."/". $today['currentMonth']."/".$today['currentYear'];
        if($date == $currentDate)
        {
            return redirect('day');
        }
        $targetDateObject = Carbon::createFromFormat('d/m/Y', $date);
        $targetDateArray = $this->dateObjectToArray($targetDateObject);
        Carbon::setTestNow($targetDateObject);

        
        $dateObjectYesterday = $targetDateObject->yesterday();
        $dateObjectTomorrow = $targetDateObject->tomorrow();

        $dateArrayYesterday = $this->dateObjectToArray($dateObjectYesterday);
        $dateArrayTomorrow = $this->dateObjectToArray($dateObjectTomorrow);
        $dayBefore = $dateArrayYesterday['currentDay'] ."/". $dateArrayYesterday['currentMonth']."/".$dateArrayYesterday['currentYear'];
        $dayAfter = $dateArrayTomorrow['currentDay'] ."/". $dateArrayTomorrow['currentMonth']."/".$dateArrayTomorrow['currentYear'];
        
        //checks if a lists exists for a corresponnding date. If there is no list, returns a null value.
        $currentList = $this->listRepository->getSpecificList($date);
        if(!(empty($currentList))){
        $currentListID = $currentList->id;
        $logsData = $this->logRepository->getSpecificLogs($currentListID);
        if(empty($logsData))
            {
                $logsData=null;
            }
        }
        else{
        $logsData = null;
        }
        $data =[
            'thisDay'=> "class = active ",
            'thisWeek'=>'',
            'thisMonth' =>'',
            'id' => 'thisDay' ];
        $dayName = $targetDateArray['currentDayName'];
        $monthName = $targetDateArray['currentMonthName'];
        $day = $targetDateArray['currentDay'];
        $year = $targetDateArray['currentYear'];

        return view('main-tabs.thisDay',$data)
            ->with('logsData',$logsData)
            ->with('dayBefore',$dayBefore)
            ->with('dayAfter',$dayAfter)
            ->with('dayName',$dayName)
            ->with('monthName',$monthName)
            ->with('day',$day)
            ->with('year',$year);;  
    }
    public function addLog()
    {
        //getting data from the inputs
    	$log_name = Input::get('log_name');
    	$log_description = Input::get('log_description');
        $date = Input::get('realLogDate');
        $minute_duration = Input::get('min1');
        $hour_duration = Input::get('hour1');
        $total_duration = ($hour_duration * 60) + $minute_duration;
        $priority = Input::get('priority');

        //creating a carbon format of the input date
        $targetDateObject = Carbon::createFromFormat('d/m/Y', $date);
        $targetDateArray = $this->dateObjectToArray($targetDateObject);

         //checks if a lists exists for a corresponnding date. If there is no list, creates a list for the specific date to be used by the log.
        $listData = $this->listRepository->getSpecificList($date);
        if(!(empty($listData)))
        {
            $id = $listData->id;
        }
        else{
            $this->listRepository->createList($date);
            $dateFind = $this->listRepository->getSpecificList($date);
            //gets the id of the created list.
            $id= $dateFind->id;
        }

                $data = [
                'log_name' => $log_name,
                'log_description'=>$log_description,
                'duration'=>$total_duration,
                'status' =>'to do',
                'retrieved_from'=>'user created',
                'is_group_log'=>'false',
                'priority'=>$priority,
                'list_id'=>$id
                ];

        $this->logRepository->createLog($data);

         return redirect ('/day')
             ->with('status', 'success')
             ->with('message', 'Log created successfully.');
    }


}
