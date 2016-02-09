<?php 
namespace App\Traits;

use Carbon\Carbon;


trait CurrentDate {

  public function getCurrentDate()
   {
                       $currentDate = Carbon::now();
                       $data = [
                        'currentDate' => $currentDate,
                        'currentYear'  =>   $currentDate->year,
                        'currentMonth' =>     $currentDate->month,
                        'currentMonthName' => $currentDate->format('F'),
                        'currentDay'   => $currentDate->day,
                        'currentDayName' => $currentDate->format('D')

                       ];
                       return $data;
   }

}