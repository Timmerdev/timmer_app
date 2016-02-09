<?php
namespace App\Logic\Log;

use App\Models\Settings;
use Hash, Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class SettingsRepository {
    
    public function __construct( Guard $auth)
    {
        $this->auth = $auth;
    }
    public function createSettings( $data )
    {

        


    }
    public function setSettings()
    {

    }
    public function getSettings()
    {
 
    }
 
    


}