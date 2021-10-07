<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    use TwoFactorAuthenticate;

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email' , $googleUser->email)->first();

            $filename=$googleUser->name . rand(1000,9999);
            if(! $user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(\Str::random(16)),
                    'two_factor_type' => 'off',
                    'file_name' => $filename
                ]);
                File::makeDirectory(public_path().'/images/users/'.$filename);

            }

            if( ! $user->hasVerifiedEmail()){
                $user->markEmailAsVerified();
            }


            auth()->loginUsingId($user->id);
            return $this->loggedin($request , $user) ?: redirect('/');
        } catch (\Exception $e) {
            //TODO Log Error Message
            alert()->error('ورود با گوگل موفق نبود' , 'شما ارور دارید')->persistent('بسیار خوب');
            return redirect('/login');
        }
    }
}
