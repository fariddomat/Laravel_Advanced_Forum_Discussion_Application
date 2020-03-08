<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SocialAuth;

class SocialsController extends Controller
{


    public function auth($provider)
    {
        return SocialAuth::authorize($provider);
    }

    public function auth_callback($provider)
    {
        SocialAuth::login($provider,function($user,$details){
//dd($details);
 
            $user->name=$details->nickname;
            $user->avatar=$details->avatar;
            $user->email=$details->email;
            $user->password="";
            $user->save();

        });

        return redirect('/home');
    }
}
