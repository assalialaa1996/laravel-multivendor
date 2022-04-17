<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\CPU\Helpers;
use Illuminate\Support\Facades\Session;
use App\Model\Admin;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function login()
    {
        $custome_recaptcha = new CaptchaBuilder;
        $custome_recaptcha->build();
        Session::put('custome_recaptcha', $custome_recaptcha->getPhrase());
        return view('admin-views.auth.login', compact('custome_recaptcha'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //recaptcha validation
        $recaptcha = Helpers::get_business_settings('recaptcha');
        if (isset($recaptcha) && $recaptcha['status'] == 1) {
            try {
                $request->validate([
                    'g-recaptcha-response' => [
                        function ($attribute, $value, $fail) {
                            $secret_key = Helpers::get_business_settings('recaptcha')['secret_key'];
                            $response = $value;
                            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $response;
                            $response = \file_get_contents($url);
                            $response = json_decode($response);
                            if (!$response->success) {
                                $fail(\App\CPU\translate('ReCAPTCHA Failed'));
                            }
                        },
                    ],
                ]);
            } catch (\Exception $exception) {}
        } else if ($recaptcha['status'] == 0) {
            $builder = new CaptchaBuilder();
            $builder->setPhrase(session()->get('custome_recaptcha'));
            if (!$builder->testPhrase($request->custome_recaptcha)) {
                Toastr::error(\App\CPU\translate('ReCAPTCHA Failed'));
                return back();
            }
        }
        $admin = Admin::where('email', $request->email)->first();
        if($admin->status !=1)
        {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                        ->withErrors(['You are blocked!!, contact with admin.']);
        }
        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status' =>$admin->status], $request->remember)) {
            
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.auth.login');
    }
}
