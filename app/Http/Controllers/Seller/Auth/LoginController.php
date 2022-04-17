<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Model\Seller;
use App\Model\SellerWallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use App\CPU\Helpers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller', ['except' => ['logout']]);
    }

    public function login()
    {
        $custome_recaptcha = new CaptchaBuilder;
        $custome_recaptcha->build();
        Session::put('custome_recaptcha', $custome_recaptcha->getPhrase());
        return view('seller-views.auth.login', compact('custome_recaptcha'));
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

        $se = Seller::where(['email' => $request['email']])->first(['status']);

        if (isset($se) && $se['status'] == 'approved' && auth('seller')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            Toastr::info('Welcome to your dashboard!');
            if (SellerWallet::where('seller_id', auth('seller')->id())->first() == false) {
                DB::table('seller_wallets')->insert([
                    'seller_id' => auth('seller')->id(),
                    'withdrawn' => 0,
                    'commission_given' => 0,
                    'total_earning' => 0,
                    'pending_withdraw' => 0,
                    'delivery_charge_earned' => 0,
                    'collected_cash' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return redirect()->route('seller.dashboard.index');
        } elseif (isset($se) && $se['status'] == 'pending') {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors(['Your account is not approved yet.']);
        } elseif (isset($se) && $se['status'] == 'suspended') {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors(['Your account has been suspended!.']);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('seller')->logout();

        $request->session()->invalidate();

        return redirect()->route('seller.auth.login');
    }
}
