<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Request_type;
use App\Models\Requests;
use App\Models\Concerns;
use App\Models\Web_App;
use App\Models\Concern_History;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PHPMailer\PHPMailer\PHPMailer;
use IDAnalyzer\CoreAPI;
use GuzzleHttp\Client;

class mainController extends Controller
{

    public function terms()
    {
        return view('terms');
    }

    public function policy()
    {
        return view('PrivacyPolicy');
    }
    public function home()
    {
        Visitor::create([]);
        $visitorCount = session('visitor_count', 0);
        $visitorCount++;
        session(['visitor_count' => $visitorCount]);

        $info = Web_App::whereIn('id', [28, 29, 30, 31])->get();
        return view('home', ['info' => $info]);
    }

    public function requirements()
    {
        return view('requirements');
    }

    public function track()
    {

        return view('track');
    }
    public function searchRequest(Request $request)
    {

        if ($request->keys == '') {
            Alert::error('PLEASE ENTER A REFERENCE KEY', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('track');
        }
        if (strpos($request->keys, 'CONCERN-') !== false) {
            $user_info = Concerns::join('users', 'users.id', '=', 'concern.resident_id')
                ->select('users.*', 'concern.*', 'concern.created_at as request_date')->where('reference_key', $request->keys)->get();
            if ($user_info->count() == 0) {
                Alert::error('INVALID REFERENCE KEY', '')->showConfirmButton('Confirm', '#AA0F0A');
            }

            return view('trackrequest', ['user_info' => $user_info]);
        } else {
            $user_info = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('reference_key', $request->keys)->get();
            if ($user_info->count() == 0) {
                Alert::error('INVALID REFERENCE KEY', '')->showConfirmButton('Confirm', '#AA0F0A');
            }
            return view('trackrequest', ['user_info' => $user_info]);
        }
    }
    public function aboutUs()
    {

        $info = Web_App::get();
        return view('aboutUs', ['info' => $info]);
    }

    public function safetySection()
    {
        return view('safetySection');
    }

    public function contact()
    {
        $info = Web_App::get();
        return view('contact', ['info' => $info]);
    }

    public function login()
    {

        $user = Auth::user();
        if ($user == null || Auth::user()->role != 'resident') {
            return view('login');
        }


        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request_type = Request_type::get();


        return view("userHome", ['user_info' => $user_info, 'request_type' => $request_type]);
    }

    public function registration()
    {
        return view('registration');
    }

    public function addUser(Request $request)
    {


        if ( User::where('email', $request->email)->where('isEnabled', 1)->exists() ) {

            $data = [
                'success' => "error",
                'message' => "error",
            ];
            return response()->json($data);
        } else {

            if ($request->file('formFile')) {
                $file_front = $request->file('formFile');
                $filename_front = $request->firstName . '_' . $request->lastName . date("Y-m-d-H-i-s") . 'frontPic.' . $file_front->getClientOriginalExtension();
                $file_front->move(public_path('/residentID'), $filename_front);
            }
            if ($request->file('formFile_2')) {
                $file_back = $request->file('formFile_2');
                $filename_back = $request->firstName . '_' . $request->lastName . date("Y-m-d-H-i-s") . 'backPic.' . $file_back->getClientOriginalExtension();
                $file_back->move(public_path('/residentID'), $filename_back);
            }

            // Retrieve the uploaded file from the request
            $userFile_front = public_path('residentID\\' . $filename_front);
            $userFile_back = public_path('residentID\\' . $filename_back);

            $fileContent_front = file_get_contents($userFile_front);
            $fileContent_back = file_get_contents($userFile_back);



            // $client = new \GuzzleHttp\Client();



            // // Convert the file content to base64 encoding
            // $base64FileContent_front = base64_encode($fileContent_front);
            // $base64FileContent_back = base64_encode($fileContent_back);


            // $post = [
            //     'file_base64' =>  $base64FileContent_front,
            //     'file_back_base64' => $base64FileContent_back,
            //     'apikey' => 'ZEZiRIDNCR8z8zkB6zpTdxdoHjvlUHiD',
            //     'authenticate' => true
            // ];
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            // $response = curl_exec($ch);

            // dd(curl_exec($ch));

            // ---------------------------------------------------------------------------------------
            // // Initialize Core API US Region with your credentials  
            // $coreapi = new CoreAPI("ZEZiRIDNCR8z8zkB6zpTdxdoHjvlUHiD", "US");

            // // Enable authentication and use 'quick' module to check if ID is authentic
            // $coreapi->enableAuthentication(true, 'quick');

            // // Analyze ID image by passing URL of the ID image and a face photo (you may also use a local file)
            // $result = $coreapi->scan("C:\xampp\htdocs\barangay\public\residentID\JAKERSON_BERMUDO2023-07-23-17-40-33frontPic.png", "","");

            // DD($result);
            // // All information about this ID will be returned in an associative array
            // $data_result = $result['result'];
            // $authentication_result = $result['authentication'];
            // $face_result = $result['face'];

            // dd($data_result);
            // if($authentication_result){  
            //     if($authentication_result['score'] > 0.5) {  
            //         dd("The document uploaded is authentic<br>");  

            //     }else if($authentication_result['score'] > 0.3){  
            //         dd("The document uploaded looks little bit suspicious<br>");  
            //     }else{  
            //         dd("The document uploaded is fake<br>");  
            //     }
            // }
            User::create([
                "first_name" => strtoupper($request->firstName),
                "middle_name" => strtoupper($request->middleName),
                "last_name" => strtoupper($request->lastName),
                "suffix" =>  strtoupper($request->suffix),
                "gender" => $request->gender,
                "marital_status" =>  $request->marital_status,
                "nationality" =>  $request->nationality,
                "birthdate" =>  $request->birthdate,
                "place_birth" =>  strtoupper($request->birthplace),
                "address_unitNo" =>  strtoupper($request->unitNo),
                "address_houseNo" =>  strtoupper($request->houseNo),
                "address_street" =>  strtoupper($request->street),
                "address_purok" =>  strtoupper($request->purok),
                "email" =>  strtolower($request->email),
                "mobile_num" =>  $request->number,
                "role" =>  $request->role,
                "password" => Hash::make($request->password),
                "valiID_type" => $request->type_validID,
                "validID_num" => $request->validID_num,
                "validID_front" => $filename_front,
                "validID_back" => $filename_back,
                "OTP" => $request->otp,
                "isEnabled" => 0
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
            $mail->addAddress(strtolower($request->email));

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
    
                    <h3 class="mb-4">Verify Your Resident Account</h3>
              
                    <h2>Verify Your Resident Account</h2>
                    <p>Dear ' . strtoupper($request->firstName) . " " . strtoupper($request->middleName) . " " . strtoupper($request->lastName) . ',</p>
                    <p>Thank you for creating your resident account. In order to complete the registration process and start using our services, please click on the link below to verify your account:</p>
                    <p><a href="http://127.0.0.1:8000/verifyEmail?email=' . strtolower($request->email) . '&key=' . $request->otp . '" class="btn btn-primary">Verify Account</a></p>
                    <p>If you did not create an account with us, please disregard this email.</p>
                    <p>Thank you,</p>
                    <p>BARANGAY SOUTH SIGNAL VILLAGE</p>
                    <br>
                    <h5 style="font-style: italic; color: gray;">This is a system generated message. Please DO NOT REPLY to this email.</h5>
                </div>
            </body>
         </html>';


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "BARANGAY SOUTH SIGNAL VILLAGE CONFIRM EMAIL VERIFIACTION";
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
        }
        return response()->json();
    }

    public function user_Dashboard()
    {


        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }

        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request_type = Request_type::get();


        return view("userHome", ['user_info' => $user_info, 'request_type' => $request_type]);
    }

    public function user_Dashboard_Profile()
    {

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        return view("userProfile", ['user_info' => $user_info]);
    }
    public function user_Dashboard_Transaction()
    {

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        return view("userDashboard", ['user_info' => $user_info]);
    }

    public function table()
    {
        $requestCounts = DB::table('requests')
            ->select('request_status', DB::raw('count(*) as count'))
            ->groupBy('request_status')
            ->get();

        return view('table', ['res' => $requestCounts]);
    }

    public function admin()
    {
        $user_info = DB::table('users')->get();

        return view('admindashboard', ['user_info' => $user_info]);
    }

    public function viewUser(Request $request, $id)
    {
        $userInfo =  DB::table('users')->where('id', $id)->get();
        return view('userDashboard', ['user_info' => $userInfo]);
    }

    public function deleteUser(Request $request, $id)
    {
        User::where('id', $id)->delete();
        $user_info = User::all();
        return redirect()->route('table', ['user_info' => $user_info]);
    }


    public function modifyEmail(Request $request)
    {
        $data = $request->all();
        $id = strtolower($data['user_id']);
        $new_email = strtolower($data["email"]);
        $userInfo =  User::where('id',  $id)->first();
        $exist =  User::where('email',  $new_email)->count();

        if ($exist > 1) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'Email already registred from different account')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        }
        if ($new_email == $userInfo->email) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'You entered your old email')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        } else {
            User::where('id',  $id)->first()->update(['email' => $new_email]);
            toast('You successfully updated your email!', 'success');
            return redirect()->route('userDashboard_Profile');
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $id = $data['user_id'];
        $newPassword = $data['newPassword'];
        $oldPassword = $data['oldPassword'];
        $password = User::where('id',  $id)->first()->password;

        if (password_verify($newPassword, $password)) {
            Alert::error('NOTHING CHANGE', 'You inputted the same password')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        } elseif (!password_verify($oldPassword, $password)) {
            Alert::error('CANNOT CHANGE PASSWORD', 'You entered wrong password')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        } else {
            toast('You successfully updated your PASSWORD!', 'success');
            User::where('id', $id)->first()->update(['password' => (Hash::make($newPassword))]);
            return redirect()->route('userDashboard_Profile');
        }
    }


    public function changeNumber(Request $request)
    {
        $data = $request->all();
        $id = strtolower($data['user_id']);
        $new_number = strtolower($data["number"]);
        $userInfo =  User::where('id',  $id)->first();

        if ($new_number == $userInfo->mobile_num) {
            Alert::error('MOBILE NUMBER UNSUCCESSFULLY UPDATED', 'You entered your mobile number')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        } else {
            User::where('id',  $id)->first()->update(['mobile_num' => $new_number]);
            toast('You successfully updated your mobile number!', 'success');
            return redirect()->route('userDashboard_Profile');
        }
    }

    public function updateID(Request $request)
    {

        $user_auth = Auth::user();

        $data = $request->all();
        $id = strtolower($data['user_id']);

        if ($request->file('formFile')) {
            $file_front = $request->file('formFile');
            $filename_front = $user_auth->id . '-' . $user_auth->first_name . '-' . $user_auth->last_name . '-' . date("Y-m-d-H-i-s") . '-frontPic.' . $file_front->getClientOriginalExtension();
            $file_front->move(public_path('/residentID'), $filename_front);
        }
        if ($request->file('formFile_2')) {
            $file_back = $request->file('formFile_2');
            $filename_back = $user_auth->id . '-' . $user_auth->first_name . '-' . $user_auth->last_name . '-' . date("Y-m-d-H-i-s") . '-backPic.' . $file_back->getClientOriginalExtension();
            $file_back->move(public_path('/residentID'), $filename_back);
        }


        User::where('id',  $id)->first()->update([
            "valiID_type" => $request->type_validID,
            "validID_num" => $request->validID_num,
            "validID_front" => $filename_front,
            "validID_back" => $filename_back,
        ]);

        toast('You successfully updated your valid ID!', 'success');
        return redirect()->route('userDashboard_Profile');
    }
    public function request_barangay_id()
    {

        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request_type = Request_type::get();
        if ($request_type[0]->isEnabled == 0) {
            Alert::error('THIS REQUEST IS CURRENTLY UNAVAILABLE', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        if (Requests::where('resident_id', $user_auth->id)->where('request_type_id', $request_type[0]->request_type_id)->where('request_status', ['Pending', 'Processing', 'Approved'])->count() != 0) {
            Alert::info('You have already submitted a request', 'Kindly track your request status or if any problem encountered please contact the Barangay')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }


        return view("barangay_id", ['user_info' => $user_info]);
    }
    public function request_barangay_clearance()
    {

        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }

        return view("barangay_clearance", ['user_info' => $user_info]);
    }

    public function transaction_history()
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('id', $user_auth->id)->get();

        $concern = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('id', $user_auth->id)->get();

        return view("transactionHistory", ['user_info' => $user_info, 'transaction' => $transactions, 'concern' => $concern]);
    }



    public function request_barangay_cedula()
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }

        return view("cedula", ['user_info' => $user_info]);
    }

    public function request_barangay_certification()
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        return view("barangay_certification", ['user_info' => $user_info]);
    }

    public function request_business_clearance()
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        return view("business_clearance", ['user_info' => $user_info]);
    }

    public function create_concern()
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        return view("userConcern", ['user_info' => $user_info]);
    }

    public function viewRequestdoc($id)
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('reference_key', $id)->get($id);

        return view("userviewRequest", ['user_info' => $user_info, 'request' => $request]);
    }
    public function viewConcernuser($id)
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request =  Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('reference_key', $id)->get()->first();
        $request_history = Concern_History::where('concern', $request->concern_id)->get();
        return view("userviewConcern", ['user_info' => $user_info, 'request' => $request, 'history' => $request_history]);
    }
}
