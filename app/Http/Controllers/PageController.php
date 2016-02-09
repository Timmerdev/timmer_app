<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {

    }
    public function getToday()
    {
        $data =[
            'thisDay'=> "class = active ",
            'thisWeek'=>'',
            'thisMonth' =>'',
            'id' => 'thisDay' ];
        return view('main-tabs.thisDay',$data);
    }
 
    public function getThisMonth()
    {
           $data = [
            'thisDay'=>'',
            'thisWeek'=>'',
            'thisMonth' =>"class = active ",
            'id' => 'thisWeek'];
        return view('main-tabs.thisMonth',$data);
    }
}
