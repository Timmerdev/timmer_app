<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\User\UserRepository;
use App\Logic\Lists\ListRepository;
use App\Logic\Log\LogRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;
use App\Models\Role;
use Input, Validator, Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{
	public function __construct( Guard $auth, UserRepository $userRepository, ListRepository $listRepository, LogRepository $logRepository )
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->listRepository = $listRepository;
        $this->logRepository = $logRepository;
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function index()
    {
        $user = Auth::user();
        return view('admin.adminHome')
            ->with('status', 'success')
            ->with('message', 'Welcome back '.$user->first_name.'!');
    }
}
