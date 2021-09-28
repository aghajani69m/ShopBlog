<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification as ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TwoFactorAuthController extends Controller
{
    public function manageTwoFactor()
    {
        return view('profile.two-factor-auth');
    }

    public function postManageTwoFactor(Request $request)
    {
        $data = $this->validateRequestData($request);

        if($this->isRequestTypeSms($data)) {
            if($request->user()->phone_number !== $data['phone']) {
                return $this->createCodeAndSendSms($request, $data);
            } else {
                $request->user()->update([
                    'two_factor_type' => 'sms'
                ]);
            }
        }

        if($this->isRequestTypeOff($data)) {
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }

        return back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function validateRequestData(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:sms,off',
            'phone' => ['required_unless:type,off', Rule::unique('users', 'phone_number')->ignore($request->user()->id)]
        ]);

        return $data;
    }

    /**
     * @param $data
     * @return bool
     */
    private function isRequestTypeSms($data): bool
    {
        return $data['type'] === 'sms';
    }

    /**
     * @param Request $request
     * @param $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function createCodeAndSendSms(Request $request, $data)
    {
        $request->session()->flash('phone', $data['phone']);

        // create a new code
        $code = ActiveCode::generateCode($request->user());
        $request->session()->flash('code', $code);
        // send the code to user phone number
//        $request->user()->notify(new ActiveCodeNotification($code, $data['phone']));

        return redirect(route('profile.2fa.phone'));
    }

    /**
     * @param $data
     * @return bool
     */
    private function isRequestTypeOff($data): bool
    {
        return $data['type'] === 'off';
    }
}
