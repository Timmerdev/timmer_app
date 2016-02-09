<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Lists\ListRepository;
use Input;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\CurrentDate;
use App\Traits\ObjectToArray;

class ListsController extends Controller
{
    use CurrentDate;
    use ObjectToArray;

	protected $listRepository;

	public function __construct(ListRepository $listRepository)
	{
		$this->listRepository = $listRepository;
        Carbon::setTestNow(); 
	}
    public function index()
    {
        //using function from the Trait currentDate.
        $targetDay= $this->getCurrentDate();
       
        //retrieving data for the next 3 days prior and after the currentDate
        $dateDayAfter = Carbon::tomorrow();
        $dateDayBefore = Carbon::yesterday();
        $dateDayAfter2 = Carbon::tomorrow()->addDay();
        $dateDayAfter3 = Carbon::tomorrow()->addDays(2);
        $weekBeforeObject = Carbon::yesterday()->subDays(6);
        $weekAfterObject = Carbon::tomorrow()->addDays(6);
        $dateDayBefore2 = Carbon::yesterday()->subDay();
        $dateDayBefore3 = Carbon::yesterday()->subDays(2);

        //putting the data in the array using the function inside the controller
        $dayAfter = $this->dateObjectToArray($dateDayAfter);
        $dayBefore = $this->dateObjectToArray($dateDayBefore);
        $dayAfter2 = $this->dateObjectToArray($dateDayAfter2);
        $dayAfter3 = $this->dateObjectToArray($dateDayAfter3);
        $dayBefore2 = $this->dateObjectToArray($dateDayBefore2);
        $dayBefore3 = $this->dateObjectToArray($dateDayBefore3);        
        $weekBefore = $this->dateObjectToArray($weekBeforeObject);
        $weekAfter = $this->dateObjectToArray($weekAfterObject);

        $data = [
            'thisDay'=> '',
            'thisWeek'=>"class = active ",
            'thisMonth' =>'',
            'id' => 'thisWeek' ];
        // $listdata = $this->listRepository->getLists();
        return view('main-tabs.thisWeek',$data)
                ->with('targetDay', $targetDay)
                ->with('dayBefore', $dayBefore)
                ->with('dayAfter', $dayAfter)
                ->with('dayAfter2', $dayAfter2)
                ->with('dayAfter3', $dayAfter3)
                ->with('dayBefore2', $dayBefore2)
                ->with('dayBefore3', $dayBefore3)
                ->with('weekYearBefore',$weekBefore['currentYear'])
                ->with('weekYearAfter',$weekAfter['currentYear'])
                ->with('weekMonthBefore',$weekBefore['currentMonth'])
                ->with('weekMonthAfter',$weekAfter['currentMonth'])
                ->with('weekDayBefore',$weekBefore['currentDay'])
                ->with('weekDayAfter',$weekAfter['currentDay']);                
    }
    public function specificDatesOfWeek($year, $month, $day)
    {
        $weekSpecified = Carbon::create($year,$month,$day,0);
        //setting the date passed as the current date for subtraction and addition using carbon functions
        Carbon::setTestNow($weekSpecified);     
        $targetDay = $this->dateObjectToArray($weekSpecified);     
        //retrieving data for the next 3 days prior and after the currentDate
        $dateDayAfter = $weekSpecified->tomorrow();
        $dateDayBefore = $weekSpecified->yesterday();
        $dateDayAfter2 = $weekSpecified->tomorrow()->addDay();
        $dateDayAfter3 = $weekSpecified->tomorrow()->addDays(2);
        $dateDayBefore2 = $weekSpecified->yesterday()->subDay();
        $dateDayBefore3 = $weekSpecified->yesterday()->subDays(2);
        $weekBeforeObject = $weekSpecified->yesterday()->subDays(6);
        $weekAfterObject = $weekSpecified->tomorrow()->addDays(6);
        //unsetting the date
        Carbon::setTestNow(); 

        //putting the data in the array using the function using the ObjectToArray Trait
        $dayAfter = $this->dateObjectToArray($dateDayAfter);
        $dayBefore = $this->dateObjectToArray($dateDayBefore);
        $dayAfter2 = $this->dateObjectToArray($dateDayAfter2);
        $dayAfter3 = $this->dateObjectToArray($dateDayAfter3);
        $dayBefore2 = $this->dateObjectToArray($dateDayBefore2);
        $dayBefore3 = $this->dateObjectToArray($dateDayBefore3);
        $weekBefore = $this->dateObjectToArray($weekBeforeObject);
        $weekAfter = $this->dateObjectToArray($weekAfterObject);      

       $data = [
            'thisDay'=> '',
            'thisWeek'=>"class = active ",
            'thisMonth' =>'',
            'id' => 'thisWeek' ];
        // $listdata = $this->listRepository->getLists();
                return view('main-tabs.thisWeek',$data)
                ->with('targetDay', $targetDay)
                ->with('dayBefore', $dayBefore)
                ->with('dayAfter', $dayAfter)
                ->with('dayAfter2', $dayAfter2)
                ->with('dayAfter3', $dayAfter3)
                ->with('dayBefore2', $dayBefore2)
                ->with('dayBefore3', $dayBefore3)
                ->with('weekYearBefore',$weekBefore['currentYear'])
                ->with('weekYearAfter',$weekAfter['currentYear'])
                ->with('weekMonthBefore',$weekBefore['currentMonth'])
                ->with('weekMonthAfter',$weekAfter['currentMonth'])
                ->with('weekDayBefore',$weekBefore['currentDay'])
                ->with('weekDayAfter',$weekAfter['currentDay']); 


    }
    public function addList()
    {
    	$realdate = Input::get('realdate');
    	$this->listRepository->createList($realdate);


        return redirect ('week')
            ->with('status', 'success')
            ->with('message', 'List created successfully.');
    }
    
}
