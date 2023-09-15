<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Reset_Password;
use PhpParser\Node\Stmt\Return_;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                    'g-recaptcha-response' => 'required|captcha',
                ]
            );
            if ($validateUser->fails()) {
                response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
                alert()->image('ReCAPTCHA Verification Required', 'Please complete the ReCAPTCHA verification to proceed.', 'https://www.google.com/recaptcha/intro/images/hero-recaptcha-invisible.gif', '120x', '120px', 'Image Alt')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->route('login');
            }


            if (!Auth::attempt(array_merge($request->only(['email', 'password']), ['isEnabled' => 1]))) {

                if (User::where('email', $request->email)->exists()) {
                    if (User::where('email', $request->email)->first()->isEnabled == 0) {
                        alert()->html('<h3>LOG-IN FAILED</h3>', "<h5><strong>PLEASE VERIFY YOUR ACCOUNT FIRST.</strong></h5><hr><p><br>If you encounter another problem, kindly contact us.</p>", 'error')->showConfirmButton('Confirm', '#AA0F0A');
                        // alert()->error('LOG-IN FAILED', 'PLEASE VERIFYY YOUR ACCOUNT FIRST (Resend your email verification)')->showConfirmButton('Confirm', '#AA0F0A');
                        return redirect()->route('login');
                    } else {
                        alert()->error('LOG-IN FAILED', 'Password is in incorrect.')->showConfirmButton('Confirm', '#AA0F0A');;
                        response()->json([
                            'status' => false,
                            'message' => 'Email & Password does not match with our record.',
                        ], 401);
                        return redirect()->route('login');
                    }
                }
                alert()->error('LOG-IN FAILED', 'Email or Password does not match with our record.')->showConfirmButton('Confirm', '#AA0F0A');;
                response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
                return redirect()->route('login');
            }



            $user = User::where('email', $request->email)->first();
            if ($user->role != 'resident') {
                alert()->error('LOG-IN FAILED', 'UNAUTHORIZE')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->route('login');
            }
            response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
            alert()->success('WELCOME', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    // this method signs out users by removing tokens
    public function signout(Request $request)
    {

        $redirect = Auth::user()->role;
        auth()->guest();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($redirect == 'resident') {
            alert()->success('SUCCESSFULLY LOGOUT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('login');
        } else {
            alert()->success('SUCCESSFULLY LOGOUT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('adminPortal');
        }
    }

    public function verifyEmail(Request $request)
    {

        if (User::where('email', $request->email)->where('otp', $request->key)->exists()) {
            User::where('email', $request->email)->where('otp', $request->key)->get()->first()->update([
                'isEnabled' => 1
            ]);
            alert()->success('ACCOUNT VERIFIED', 'Your account has been successfully verified')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('login');
        } else {
            alert()->error('INVALID LINK', 'This link is invalid')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
    }
    public function forgetpasswordpage()
    {
        return view('forgotpassword');
    }

    public function forgetpassword(Request $request)
    {
        if (User::where('email', $request->email)->exists() && User::where('email', $request->email)->get()->first()->isEnabled == 1) {
            $user = User::where('email', $request->email)->get()->first();
            Reset_Password::create([
                'email' => $request->email,
                'key' => $user->password,
                'token' => $request->_token
            ]);
            $data = [
                'fullname' => $request->firstName . " " . $request->lastName . " " . $request->suffix,
                'link' => env('APP_URL') . '/forgetpassword_enter_page?email= ' . strtolower($request->email) . "&key=" . $user->password . "&token=" . $request->_token
            ];

            Mail::to($request->email)->send(new ForgetPassword($data));
            $data = [
                'success' => true,
                'message' => "success",
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => true,
                'message' => "error",
            ];
            return response()->json($data);
        }
    }

    public function forgetpassword_enter_page(Request $request)
    {
        if (
            Reset_Password::where('email', $request->email)->where('key', $request->key)->where('token', $request->token)->exists() &&
            User::where('email', $request->email)->where('password', $request->key)->exists()
        ) {

            $resetPassword = Reset_Password::where('token', $request->token)->first();

            if ($resetPassword && $resetPassword->expired_at && Carbon::now()->gt($resetPassword->expired_at)) {
                alert()->error('LINK EXPIRED', 'This link is already expired')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->route('home');
            } else {
                return view('forgotpassword_input', ['email' => $request->email, 'key' => $request->key]);
            }
        } else {
            alert()->error('INVALID LINK', 'This link is invalid')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
    }

    public function changing_password(Request $request)
    {
        if (password_verify($request->newPassword, User::where('email', $request->email)->get()->first()->password)) {
            alert()->error('RESET PASSWORD FAILED', 'You input your old password')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
        if (User::where('email', $request->email)->where('password', $request->key)->exists()) {
            User::where('email', $request->email)->get()->first()->update([
                'password' => Hash::make($request->newPassword),
            ]);
            alert()->success('PASSWORD SUCCESSFULLY RESET', 'Your password has been successfully reset.')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            alert()->error('INVALID LINK', 'This link is invalid')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
    }
}
