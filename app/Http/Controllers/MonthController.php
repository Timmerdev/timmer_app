<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\CurrentDate;

class MonthController extends Controller
{
    use CurrentDate;
   public function index()
   {
						//retrieving data from the getCurrentDate function to be passed to calendarView and then the view itself
					   $getDate = $this->getCurrentDate();
					   $year = $getDate['currentYear'];
					   $month=$getDate['currentMonth'];
					   $monthName=$getDate['currentMonthName'];
					   /* draw table */
					   $calendar = $this->calendarView($month, $year);

					   //checking of the month+year before and after the current month
					   $checkDate = $this->checkDateMove($month, $year);
					   $monthBefore = $checkDate['monthBefore'];
					   $monthAfter = $checkDate['monthAfter'];
					   $beforeYear = $checkDate['beforeYear'];
						$afterYear = $checkDate['afterYear'];
						//conditionals for the next month and month before tabs;

	/* all done, return result */
	$data = [
            'thisDay'=>'',
            'thisWeek'=>'',
            'thisMonth' =>"class = active ",
            'id' => 'thisWeek'];
	return view('main-tabs.thisMonth',$data)
			->with('calendar',$calendar)
			->with('monthName',$monthName)
			->with('year',$year)
			->with('monthBefore',$monthBefore)
			->with('beforeYear',$beforeYear)
			->with('monthAfter',$monthAfter)
			->with('afterYear',$afterYear);
   }

   //actions for moving calendar monthly view forward/backward
   public function getMonthMove($month, $year)
   {
   	
   		$currentDate = $this->getCurrentDate();
   		$currentYear = $currentDate['currentYear'];
		$currentMonth=$currentDate['currentMonth'];
			if(($currentMonth == $month) && ($currentYear == $year))
					{
						return redirect('thisMonth');
					}
   		$getDate = Carbon::createFromDate($year, $month, null);
   		$monthName=$getDate->format('F');
   		$calendar = $this->calendarView($month, $year);
   		$checkDate = $this->checkDateMove($month, $year);
					   $monthBefore = $checkDate['monthBefore'];
					   $monthAfter = $checkDate['monthAfter'];
					   $beforeYear = $checkDate['beforeYear'];
						$afterYear = $checkDate['afterYear'];

		$data = [
            'thisDay'=>'',
            'thisWeek'=>'',
            'thisMonth' =>"class = active ",
            'id' => 'thisWeek'];				

		return view('main-tabs.thisMonth',$data)
			->with('calendar',$calendar)
			->with('monthName',$monthName)
			->with('year',$year)
			->with('monthBefore',$monthBefore)
			->with('beforeYear',$beforeYear)
			->with('monthAfter',$monthAfter)
			->with('afterYear',$afterYear);
   }

   //action for searching specific dates; same method applied from getMonthMove
   public function getSpecificDate()
   {
   
   		$date = Input::get('searchDate');
   		$currentDate = $this->getCurrentDate();
   		$currentYear = $currentDate['currentYear'];
		$currentMonth=$currentDate['currentMonth'];
		$searchDate =  Carbon::createFromFormat('d/m/Y', $date);
		$searchYear = $searchDate->year;
		$searchMonth = $searchDate->month;
		$monthName=$searchDate->format('F');
			if(($searchYear == $currentYear) && ($searchMonth == $currentMonth))
					{
						return redirect('thisMonth');
					}
		$calendar = $this->calendarView($searchMonth, $searchYear);
   		$checkDate = $this->checkDateMove($searchMonth, $searchYear);
					   $monthBefore = $checkDate['monthBefore'];
					   $monthAfter = $checkDate['monthAfter'];
					   $beforeYear = $checkDate['beforeYear'];
						$afterYear = $checkDate['afterYear'];

		$data = [
            'thisDay'=>'',
            'thisWeek'=>'',
            'thisMonth' =>"class = active ",
            'id' => 'thisWeek'];				

		return view('main-tabs.thisMonth',$data)
			->with('calendar',$calendar)
			->with('monthName',$monthName)
			->with('year',$searchYear)
			->with('monthBefore',$monthBefore)
			->with('beforeYear',$beforeYear)
			->with('monthAfter',$monthAfter)
			->with('afterYear',$afterYear);
   }

   
   public function calendarView($month, $year)
   {
   
   						//instantiating the getCurrentDate function
   					   $currentDate = $this->getCurrentDate();

   					   /* start for the table */
   					   $calendar = '<table cellpadding="0" cellspacing="0" class="table table-hover calendar">';

						/* table headings */
						$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
						$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

						/* days and weeks vars now ... */
						$running_day = date('w',mktime(0,0,0,$month,1,$year));
						$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
						$days_in_this_week = 1;
						$day_counter = 0;
						$dates_array = array();

						/* row for week one */
						$calendar.= '<tr class="calendar-row">';

						/* print "blank" days until the first of the current week */
						for($x = 0; $x < $running_day; $x++):
							$calendar.= '<td class="calendar-day-np"> </td>';
							$days_in_this_week++;
						endfor;

						/* keep going with days.... */
						for($list_day = 1; $list_day <= $days_in_month; $list_day++):
							$calendar.= '<td class="calendar-day">';
								/* add in the day number */

								// this conditional will check if the date is the current one by comparing the data retrieved from the function get
								if(($list_day == $currentDate['currentDay']) &&($month == $currentDate['currentMonth']) && ($year == $currentDate['currentYear']))
								{
									$calendar.= '<div class="day-number-today">';	
								}
								else
								{
									$calendar.= '<div class="day-number">';
								}
								$calendar.= "<a href= ".url('targetDay/'.$list_day.'/'.$month.'/'.$year) .' class="calendar-number" >'. $list_day.'</a> </div>';

								/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
								$calendar.= str_repeat('<p> </p>',2);
								
							$calendar.= '</td>';
							if($running_day == 6):
								$calendar.= '</tr>';
								if(($day_counter+1) != $days_in_month):
									$calendar.= '<tr class="calendar-row">';
								endif;
								$running_day = -1;
								$days_in_this_week = 0;
							endif;
							$days_in_this_week++; $running_day++; $day_counter++;
						endfor;

						/* finish the rest of the days in the week */
						if($days_in_this_week < 8):
							for($x = 1; $x <= (8 - $days_in_this_week); $x++):
								$calendar.= '<td class="calendar-day-np"> </td>';
							endfor;
						endif;

						/* final row */
						$calendar.= '</tr>';

						/* end the table */
						$calendar.= '</table>';

						return $calendar;
   }

  

   //checks if the month corresponding to each movement is according to the calendar
   public function checkDateMove($month, $year)
   {
   						$monthBefore = $month - 1;
   						//checks if the beforeMonthVariable is 0 (1 is January) ; if it's true, the month is set to 12 (december), and the year is decremented
							if($monthBefore == 0)
							{
								$monthBefore = 12;
								$beforeYear = $year - 1;
							}
							else
							{
								$beforeYear = $year;
							}
						//same as above, but on incrementing the year while setting month to January (checks if next month is January)
						$monthAfter = $month + 1;
							if($monthAfter == 13)
							{
								$monthAfter = 1;
								$afterYear = $year + 1;
							}
							else
							{
								$afterYear=$year;
							}
					$data = ['monthBefore' => $monthBefore,
					'monthAfter' => $monthAfter,
					'beforeYear' =>$beforeYear,
					'afterYear'=>$afterYear
					];

				return $data;
   }
}
