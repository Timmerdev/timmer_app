<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Logic\User\UserRepository;
use App\Logic\Lists\ListRepository;
use App\Logic\Log\LogRepository;
use App\Logic\Social\SocialRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;
use App\Models\Role;
use Input, Validator, Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Traits\ObjectToArray;
use Carbon\Carbon;

class AuthController extends Controller {

    use ObjectToArray;
    protected $auth;
    protected $userRepository;
    protected $listRepository;
    protected $socialRepository;
    protected $logRepository;

    public function __construct( Guard $auth, UserRepository $userRepository, ListRepository $listRepository, LogRepository $logRepository, SocialRepository $socialRepository )
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->listRepository = $listRepository;
        $this->logRepository = $logRepository;
        $this->socialRepository = $socialRepository;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function Login()
    {
        return view('auth.login',['facebook'=>'facebook','google' =>'google']);
    }

        public function postLogin()
    {
        $email      = Input::get('email');
        $password   = Input::get('password');
        $remember   = Input::get('remember');

        if($this->auth->attempt([
            'email'     => $email,
            'password'  => $password
        ], $remember == 1 ? true : false))
        {
                    if( $this->auth->user()->hasRole('user'))
                    {
                         $this->checkFutureList();
                         return redirect('/check');
                    }

                    if( $this->auth->user()->hasRole('administrator'))
                    {
                        return redirect('adminHome');
                    }
               
        }
        else
        {
            return redirect()->back()
                ->with('message','Incorrect email or password')
                ->with('status', 'danger')
                ->withInput();
        }

    }


    public function Register()
    {
        return view('auth.register',['facebook'=>'facebook','google' =>'google']);
    }

    public function postRegister()
    {
        $input = Input::all();
        $validator = Validator::make($input, User::$rules, User::$messages);
        if($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // if($this->captchaCheck() == false)
        // {
        //     return redirect()->back()
        //         ->withErrors(['Wrong Captcha'])
        //         ->withInput();
        // }

        $data = [
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'password'      => $input['password']
        ];

        $this->userRepository->register($data);

        return redirect('login')
            ->with('status', 'success')
            ->with('message', 'You are registered successfully. Please login.');

    }


   
    public function Redirect( $provider )
    {
         $providerKey = \Config::get('services.' . $provider);
        if(empty($providerKey))
            return view('pages.status')
                ->with('error','No such provider');

            return Socialite::driver( $provider )->redirect();

    }

    /**
     * Obtain the user information from the social media site.
     *
     * @return Response
     */
    public function Callback( $provider )
    {
         $user = Socialite::driver( $provider )->user();

        $socialUser = null;


        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();
        if(!empty($userCheck))
        {
            $socialUser = $userCheck;
        }
        else
        {
            $sameSocialId = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider )->first();

            if(empty($sameSocialId))
            {
                //There is no combination of this social id and provider, so create new one

                $name = explode(' ', $user->name);

                $data = [
                'first_name'    => $name[0],
                'last_name'     => $name[1],
                'email'         => $email,
                ];
                $this->userRepository->SocialRegister($newSocialUser);
                $socialData['social_id'] = $user->id;
                $socialData['provider']= $provider;
                $socialRepository->saveSocial($socialData);

                $role = Role::whereName('user')->first();
                $newSocialUser->assignRole($role);
                $socialUser = $newSocialUser;
            }
            else
            {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
                
            }
        }
        $this->auth->login($socialUser, true);
        if( $this->auth->user()->hasRole('user'))
        {
            $this->checkFutureList();
            return redirect('check');
        }

        if( $this->auth->user()->hasRole('administrator'))
        {
            return redirect('adminHome');
        }


    }

    public function checkFutureList()
    {
        //gets date for the next 3 days after the user logs in
        $dateTomorrow = Carbon::tomorrow();
        $dateNextDay = Carbon::tomorrow()->addDay();
        $dateNextTwoDays = Carbon::tomorrow()->addDays(2);

        //turning the date objects into an array to be passed in the function for checking
        $arrayTomorrow = $this->dateObjectToArray($dateTomorrow);
        $arrayNextDay = $this->dateObjectToArray($dateNextDay);
        $arrayNextTwoDays = $this->dateObjectToArray($dateNextTwoDays);

        //checking if data exists for the upcoming days (max 3). If a list exists for the date, skip, else create a list amd get the data that coincides the day
        $this->checkDataExists($arrayTomorrow);
        $this->checkDataExists($arrayNextDay);
        $this->checkDataExists($arrayNextTwoDays);

    }
    //self explanatory
    public function checkDataExists($date)
    {
        $dateChecker = $this->listRepository->getSpecificList( $date['currentDay'] ."/". $date['currentMonth']."/".$date['currentYear'] );
            if(!(is_null($dateChecker)))
            {
                $this->getLastWeekData($date['currentYear'],$date['currentMonth'],$date['currentDay'],$dateChecker->id);
            }
            else{
                $this->listRepository->createList($date['currentDay']."/".$date['currentMonth']."/".$date['currentYear']);
            }
    }
    //getting the last week's data to be inserted to the target list
    public function getLastWeekData($year, $month, $day, $date_id)
    {
        //creating the date in carbon data for subtraction of days
        $weekSpecified = Carbon::create($year,$month,$day,0);
        Carbon::setTestNow($weekSpecified); 
        $lastWeekObject = $weekSpecified->yesterday()->subDays(6);
        $lastWeekArray = $this->dateobjectToArray($lastWeekObject);
        $lastWeekParameters = $lastWeekArray['currentDay']."/".$lastWeekArray['currentMonth']."/".$lastWeekArray['currentYear'];
        $lastWeekLogs = $this->logRepository->getSpecificLogs($date_id);


    }

    public function getLogout()
    {
        \Auth::logout();

        return redirect('login')
            ->with('status', 'success')
            ->with('message', 'You\'ve successfully logged out.');
    }

}