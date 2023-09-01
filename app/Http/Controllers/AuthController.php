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


                alert()->image('ReCAPTCHA Verification Required','Please complete the ReCAPTCHA verification to proceed.','https://www.google.com/recaptcha/intro/images/hero-recaptcha-invisible.gif','120x','120px', 'Image Alt')->showConfirmButton('Confirm', '#AA0F0A');

                // alert()->error('Captcha Error','Please verify that you are not a robot.')->showConfirmButton('Confirm', '#AA0F0A');

                // toast('Please verify that you are not a robot.','error');
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

        // $user = User::where('email', $request->email)->where('otp',$request->key)->get()->first();
        // dd($user);

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
            $mail = new PHPMailer(true);     // Passing true enables exceptions
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'jakersonbermudo98@gmail.com';   //  sender username
            $mail->Password = 'pupszejyyuypahsb';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom($mail->Username, 'Barangay South Signal Village');
            $mail->addAddress(strtolower($user->email));

            $message  = '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>body{height: 100vh;display: flex;justify-content: center;align-items: center;background: linear-gradient(45deg,#e43a15,#e65245)}.card{width: 400px;padding: 80px 50px;position: relative;border-radius: 20px;box-shadow: 0 5px 25px rgba(0,0,0,0.2)}.card h3{color: #111;margin-bottom: 50px;border-left: 5px solid red;padding-left: 10px;line-height: 1em}.inputbox{margin-bottom: 50px}.inputbox input{position:absolute;width: 300px;background:transparent}.inputbox input:focus{color: #495057;background-color: #fff;border-color: #e54b38;outline: 0;box-shadow: none}.inputbox span{position: relative;top: 7px;left: 1px;padding-left: 10px;display: inline-block;transition: 0.5s}.inputbox input:focus ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}.inputbox input:valid ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}</style>
            </head>
            <body>
            <link
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
                    rel="stylesheet"
                    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
                    crossorigin="anonymous">
                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                    crossorigin="anonymous"></script>
                <div class="card">
                <img src="https://th.bing.com/th/id/OIP.7mLt__Duzbo-CN0xL3JT9gHaHa?pid=ImgDet&rs=1" alt="Barangay South SIgnal Village Logo"  class="rounded float-start" alt="southsignal" style="width: 125px ;">
    
                    <h3 class="mb-4">Reset your password</h3>
              
                    <h2>Verify to reset your password</h2>
                    <p>Dear ' . strtoupper($user->first_name) . " " . strtoupper($user->middle_name) . " " . strtoupper($user->last_name) . ',</p>
                    <p>You recently requested to reset your password for your account on Barangay South Signal Village Web App. To complete the process, please click the link below:</p>
                    <p><a href="http://127.0.0.1:8000/forgetpassword_enter_page?email=' . strtolower($request->email) . '&key=' . $user->password . '&token=' . $request->_token . '" class="btn btn-primary">Reset Password</a></p>
                    <p>If you did not request a password reset, please ignore this email.</p>
                    <p>If you need assistance resetting your password, please contact our support team.</p>
                    <p>Thank you,</p>
                    <p>BARANGAY SOUTH SIGNAL VILLAGE</p>
                    <br>
                    <h5 style="font-style: italic; color: gray;">This is a system generated message. Please DO NOT REPLY to this email.</h5>
                </div>
            </body>
         </html>';


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "BARANGAY SOUTH SIGNAL VILLAGE RESET PASSWORD";
            $mail->Body    = $message;

            // $mail->AltBody = plain text version of email body;

            if (!$mail->send()) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }


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
