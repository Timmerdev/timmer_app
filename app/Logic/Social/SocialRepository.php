<?php
namespace App\Logic\Social;

use Illuminate\Contracts\Auth\Guard;
use App\Models\Social;


class SocialRepository {

   
	public function __construct( Guard $auth)
	{
		$this->auth = $auth;
	}
    public function saveSocial( $data )
    {
    	
        $social = new Social;
        $social->user_id = $data['social_id'];
        $social->provider = $data['provider'];
       	$social->save();

    }

}