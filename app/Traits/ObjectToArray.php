<?php 
namespace App\Traits;

use Carbon\Carbon;


trait ObjectToArray {

  public function dateObjectToArray($date)
    {
        $data = [
        'currentYear' => $date->year,
        'currentMonth'=> $date->month,
        'currentMonthName' => $date->format('F'),
        'currentDay'   => $date->day,
        'currentDayName' => $date->format('D')
        ];

        return $data;
    }

}