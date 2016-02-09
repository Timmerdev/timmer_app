<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\User\UserRepository;
use App\Logic\Lists\ListRepository;
use App\Logic\Log\LogRepository;
use App\Logic\Settings\SettingsRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;
use Input, Validator, Auth;
use App\Traits\ObjectToArray;
use Carbon\Carbon;

class SettingsController extends Controller
{
    use ObjectToArray;
    protected $auth;
    protected $userRepository;
    protected $listRepository;
    protected $logRepository;

    public function __construct( Guard $auth, UserRepository $userRepository, ListRepository $listRepository, LogRepository $logRepository )
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->listRepository = $listRepository;
        $this->logRepository = $logRepository;
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function getSettingsPage()
    {
    	return view('main-tabs.settings');
    }
}
