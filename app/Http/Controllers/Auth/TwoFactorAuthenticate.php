<?php


namespace App\Http\Controllers\Auth;


use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use App\Notifications\LoginToWebsiteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

trait TwoFactorAuthenticate
{
    public function loggedin(Request $request , $user)
    {
        if($user->hasTwoFactorAuthenticatedEnabled()) {
            return $this->logoutAndRedirectToTokenEntry($request , $user);
        }
        $user->notify(new LoginToWebsiteNotification());
        return false;
    }

    public function logoutAndRedirectToTokenEntry(Request $request , $user)
    {
        auth()->logout();

        $request->session()->flash('auth' , [
            'user_id' => $user->id,
            'using_sms' => false,
            'remember' => $request->has('remember')
        ]);


        if($user->hasSmsTwoFactorAuthenticationEnabled()) {
            $code = ActiveCode::generateCode($user);

//            $user->notify(new ActiveCodeNotification($code , $user->phone_number));

            $request->session()->push('auth.using_sms' , true);
            $request->session()->flash('code' , $code);
        }

        return redirect(route('2fa.token'));
    }
}
