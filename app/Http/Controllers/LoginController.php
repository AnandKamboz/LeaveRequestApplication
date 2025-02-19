<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleType;
use App\Models\District;
use App\Models\Game;
use App\Models\User;
use App\Models\Otp;
use App\Models\CashAward;
use App\Models\RoleGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Session;

class LoginController extends Controller
 {
    public function index()
    {
        return view( 'login' );
    }

    public function LoginOtp($id)
    {
        $captchaCode = Str::random(6);
        Session::put('captcha_code', $captchaCode);
        $otp = Otp::select('mobile')->where('secure_id', $id)->where('status', 0)->first();
        if (!$otp) {
            return redirect()->back()->with('error', 'OTP record not found.');
        }
        $mobile = substr($otp->mobile, -4);
        $user = User::where('mobile', $otp->mobile)->first();

        // if ($user) {
        //     $role = \DB::table('role_types')->where('user_id', $user->id)->first();
        //     if ($role && $role->role_id == 7) {
        //     if ($user->status == 'inactive') {
        //             return view('admin.inactive.index');
        //         }
        //     }
        // }

        $msg = 'OTP Sent to your registered mobile No. ******' . $mobile . '';
        return view('otp.otp', ['token' => $id, 'msg' => $msg]);
    }

    // Here 


    public function verifyOtp($id, Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'captcha_input' => 'required',
        ]);

        $ipAddress = $request->ip();
        $cacheKey = 'otp_attempts_' . $ipAddress;
        $blockedKey = 'otp_blocked_' . $ipAddress;

        if (Cache::has($blockedKey)) {
            $blockedUntil = Cache::get($blockedKey);
            $remainingTime = now()->diffInSeconds($blockedUntil);
            $minutes = intdiv($remainingTime, 60);
            $seconds = $remainingTime % 60;

            return back()->withErrors(['otp' => "Too many attempts. Try again in {$minutes} min {$seconds} sec."]);
        }

        if ($request->input('captcha_input') !== Session::get('captcha_code')) {
            $this->generateCaptchaCode();
            return back()->withErrors(['captcha_input' => 'Captcha code is incorrect. Please try again.']);
        }

        $otp = Otp::where('secure_id', $id)
            ->where('status', 0)
            ->where('otp', $request->input('otp'))
            ->first();

        // dd($otp);

        if ($otp && now()->lessThanOrEqualTo($otp->expires_at)) {
            Cache::forget($cacheKey);

            $otp->status = 1;
            $otp->save();

            $user = User::where('secure_id', $otp['user_id'])->first();
            // dd($user);


        


            $group = RoleType::where('user_id', $user->id)->first();
            if ($group && $group->role_id == 2) {
               return redirect('admin/dashboard');
            }

        
        } elseif ($otp && now()->greaterThan($otp->expires_at)) {
            return back()->withErrors(['otp' => 'The OTP has expired. Please request a new one.']);
        }

        $attempts = Cache::increment($cacheKey);

        if ($attempts === 1) {
            Cache::put($cacheKey, 1, now()->addMinute());
        }

        // Block user after 5 attempts
        if ($attempts >= 5) {
            $blockUntil = now()->addMinutes(30);
            Cache::put($blockedKey, $blockUntil, $blockUntil);
            Cache::forget($cacheKey);

            return back()->withErrors(['otp' => 'Too many attempts. Try again in 30 min 0 sec.']);
        }

        return back()->withErrors(['otp' => 'The OTP is not valid.']);
    }

    private function generateCaptchaCode()
    {
        $captchaCode = Str::random(6);
        Session::put('captcha_code', $captchaCode);
    }


    public function resendOtp($id, Request $request)
    {
        $otpCode = env('APP_ENV') === 'local' ? '111111' : $this->generateNumericOTP(6);
        $otp = Otp::where('secure_id', $id)->where('status', 0)->first();
        if ($otp) {
            $otp->otp = $otpCode;
            $otp->expires_at = now()->addMinutes(10);
            $otp->save();

            if (env('APP_ENV') === 'local') {
                $tem_id = '1007056441918679505';
                $message = 'Dear User, '.$otpCode. ' is OTP for Login, Cash Award Management System. Sports Department, Haryana';
                $this->sendSMS( $otp->mobile, $message, $tem_id);
                return redirect()->back()->with('success', "OTP Sent Successfully");
            }
            if (env('APP_ENV') === 'production') {
                $tem_id = '1007056441918679505';
                $message = 'Dear User, '.$otpCode. ' is OTP for Login, Cash Award Management System. Sports Department, Haryana';
                $this->sendSMS( $otp->mobile, $message, $tem_id);
                return redirect()->back()->with('success', 'OTP sent successfully.');
            }
        }
        return redirect()->back()->with('error', 'No active OTP associated with the provided mobile number. Please try again.');
    }


        public function loginVerify( Request $request )
        {
            $user = $request->only('phone');

            $app_env = env( 'APP_ENV' );
            $userr  = User::where( 'mobile', $user[ 'phone' ] )->first() ?? '';
           

            if ($userr == '') {
                $errorMessage = ['email' => 'The provided credentials do not match our records.'];
                if (request()->ajax()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $errorMessage
                    ], 422); 
                }
                return back()->withErrors($errorMessage)->onlyInput('email');
            }



            if ( !empty( $userr ) ) {
                $secureId = bin2hex( random_bytes( 16 ) );
                // $otpp = $this->generateNumericOTP( 6 );
                if ( $app_env == 'local' ) {
                    $otpp = '111111';
                    $otp = new Otp;
                    $otp->secure_id = $secureId;
                    $otp->mobile = $userr->mobile;
                    $otp->user_id = $userr->secure_id;
                    $otp->status = 0;
                    $otp->expires_at = now()->addMinutes(10);
                    $otp->otp = $otpp;
                    $otp->save();
                    
                    // $message = 'Dear User, '.$otpp. ' is OTP for Login, Cash Award Management System. Sports Department, Haryana';
                    // $temp_id = '1007056441918679505';
                    // $this->sendSMS( $userr->mobile, $message, $temp_id );
                }
                if ( $app_env == 'production' ) {
                    $otpp = $this->generateNumericOTP( 6 );
                    $otp = new Otp;
                    $otp->secure_id = $secureId;
                    $otp->mobile = $userr->mobile;
                    $otp->user_id = $userr->secure_id;
                    $otp->status = 0;
                    $otp->expires_at = now()->addMinutes(10);
                    $otp->otp = $otpp;
                    $otp->save();
                    // $message = 'Dear User, '.$otpp. ' is OTP for Login, Cash Award Management System. Sports Department, Haryana';
                    // $temp_id = '1007056441918679505';
                    // $this->sendSMS( $userr->mobile, $message, $temp_id );
                }

                $redirectUrl = url('login/otp/' . $secureId);

                return response()->json([
                    'status' => 'success',
                    'redirect_url' => $redirectUrl
                ]);

            }
            return back()->withErrors( [
                'email' => 'The provided credentials do not match our records.',
            ] )->onlyInput( 'email' );
        }


        public function logout( Request $request )
        {
            Auth::logout();
            return redirect( 'login' );
        }


        public function checkMobileNumber( Request $request )
        {
            $mobile_number = CashAward::where( 'mobile_number', $request->user_mobile_number )->get();
            if ( count( $mobile_number ) > 0 ) {
                return response()->json( [ 'status' => 'success', 'message' => 'Mobile number found' ] );
            } else {
                return response()->json( [ 'status' => 'error', 'message' => 'Mobile number not found' ] );
            }

        }

    }
