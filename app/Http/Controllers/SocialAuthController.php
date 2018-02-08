<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use JWTAuth;

class SocialAuthController extends Controller
{
    public function providerRedirect($provider = ''){

        if(!in_array($provider,['facebook','google']))
            return redirect('/login')->withErrors('This is not a valid link.');

        return Socialite::driver($provider)->redirect();
    }

    public function providerRedirectCallback($provider = '')
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/auth/social');
        }

        $user_exists = \App\User::whereEmail($user->email)->first();

        if($user_exists)
            $token = JWTAuth::fromUser($user_exists);
        else {
           $new_user = new \App\User;
            $new_user->email = $user->email;
            $new_user->provider = $provider;
            $new_user->provider_unique_id = $user->id;
            $new_user->status = 'activated';
            $new_user->activation_token = generateUuid();
			 $name = explode(' ',$user->name);
			$new_user->first_name = array_key_exists(0, $name) ? $name[0] : 'John';
            $new_user->last_name = array_key_exists(1, $name) ? $name[1] : 'Doe';
            $new_user->save();
           
            $token = JWTAuth::fromUser($new_user);
        }
//jngi
        \Cache::put('jwt_token', $token, 1);
        return redirect('/social');
    }

    public function getToken(){
        if(!\Cache::has('jwt_token'))
            return response()->json(['message' => 'Invalid request.'],422);

        $token = \Cache::get('jwt_token');
        \Cache::forget('jwt_token');
        return response()->json(['message' => 'You are successfully logged in!', 'token' => $token]);
    }
}
