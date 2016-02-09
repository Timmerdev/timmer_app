<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    	if($user == null)
        {
            $data = ['facebook'=>'facebook','google' =>'google'];
            return view('auth.login',$data);
        }
        return redirect('/day'); 
    }
    //checks user if logged in
    public function checkUser()
    {
        $user = Auth::user();

        if($user == null)
        {
            return redirect('login')
            ->with('status', 'danger')
            ->with('message', 'You need to log in to access that page.');
        }

        return redirect('/day')
            ->with('status', 'success')
            ->with('message', 'Welcome back '.$user->first_name.'!');


    }
    //same as above, but with little difference.
    public function getSuccess()
    {
        $user = Auth::user();

        if($user == null)
        {
            return redirect('login')
            ->with('status', 'danger')
            ->with('message', 'You need to log in to access that page.');
        }
        
        $data = [
            'thisDay'=> "class = active ",
            'thisWeek'=>'',
            'thisMonth' =>'',
            'id' => 'thisDay' ];
        return view('main-tabs.thisDay',$data);
    }
    public function getDocumentation()
    {

        return view('pages.documentation');
    }
   
}
