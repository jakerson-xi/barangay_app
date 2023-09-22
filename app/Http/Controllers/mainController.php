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
use Illuminate\Support\Facades\Mail;
use App\Mail\Registration;
use IDAnalyzer\DocuPass;
use IDAnalyzer\Vault;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class mainController extends Controller
{


    public function registration_id()
    {

        $docupass = new DocuPass(ENV('ID_ANALYZER'), "BARANGAY SOUTH SIGNAL VILLAGE WEB APP", "US");
        $docupass->enableFaceVerification(true, 1, 0.7);
        $docupass->verifyAge("18-120");
        $docupass->enableAuthentication(true, "2", 0.7);
        $docupass->enableDualsideCheck(true);
        $docupass->setMaxAttempt(2);
        $docupass->setRedirectionURL(Env('APP_URL') . "/registration", "");
        $docupass->verifyExpiry(true);
        $docupass->setReusable(true);
        $docupass->setWelcomeMessage("We need to verify your ID before you can create a resident account for the Barangay South Signal Village Web App.");
        $result = $docupass->createIframe();

        return view('idAnalyzer', ['frame' => $result]);
    }

    public function registration(Request $request)
    {

       
        $ref = 'docupass_reference=' . $request->reference;
        $vault = new Vault(ENV('ID_ANALYZER'), "US");
        $vaultItems = $vault->list([$ref])['items']['0'];
        // return view('registration', ['item' =>  $vaultItems]);


        //    dd($vaultItems);
        return view('registration', ['item' =>  $vaultItems, 'ref' => $request->reference]);
        // $searchTerm = 'south signal village';

        // // Define an array of addresses to search
        // $addresses = [$vaultItems['address1'], $vaultItems['address2']];

        // // Initialize a variable to track whether the search term was found
        // $found = false;

        // // Loop through the addresses
        // foreach ($addresses as $address) {
        //     // Convert the address and search term to lowercase and remove spaces
        //     $address = str_replace(' ', '', strtolower($address));
        //     $searchTerm = str_replace(' ', '', strtolower($searchTerm));

        //     // Check if the modified address contains the modified search term
        //     if (strpos($address, $searchTerm) !== false) {
        //         // The string 'southsignalvillage' (case-insensitive and spaces removed) was found in the current address
        //         $found = true;
        //         break; // Exit the loop since we found a match
        //     }
        // }

        // if ($found) {

        //     return view('registration', ['item' =>  $vaultItems, 'ref' => $request->reference ]);
        // } else {
        //     Alert::error('Invalid Address', 'We only accept IDs with an address in South Signal Village')->showConfirmButton('Confirm', '#AA0F0A');
        //     return redirect()->route('home');
        // }
    }

    public function addUser(Request $request)
    {

    
        $ref = 'docupass_reference=' . $request->ref;
        $vault = new Vault(ENV('ID_ANALYZER'), "US");
        $vaultItems = $vault->list([$ref])['items']['0'];

        $fullname = $request->firstName . " " . $request->middleName . " " . $request->lastName;




        // check if the name from the ID and from the reqistration is true
        if ($vaultItems['fullName'] != $request->firstName . " " . $request->middleName . " " . $request->lastName && levenshtein($vaultItems['fullName'], $fullname) > 6) {
           
            $data = [
                'success' => "error",
                'type' => "The name on your ID does not match the name you have submitted.",
                'message' => "error ID",
                
            ];
  
            return response()->json($data);
        }




        if (User::where('email', $request->email)->where('isEnabled', 1)->exists()) {

            $data = [
                'success' => "error",
                'message' => "error",
            ];
            return response()->json($data);
        } else {


            if ($request->has('formFile')) {
                $url = $request->input('formFile');
                $response = Http::get($url);

                if ($response->successful()) {
                    $contents = $response->body();
                    $filename_front = $request->input('firstName') . '_' . $request->input('lastName') . date('Y-m-d-H-i-s') . 'frontPic.' . pathinfo($url, PATHINFO_EXTENSION);
                    $file_path = public_path('/residentID') . '/' . $filename_front;

                    // Save the downloaded file to the server
                    file_put_contents($file_path, $contents);
                }
            }
            if ($request->has('formFile_2')) {
                $url = $request->input('formFile_2');
                $response = Http::get($url);

                if ($response->successful()) {
                    $contents_back = $response->body();
                    $filename_back = $request->input('firstName') . '_' . $request->input('lastName') . date('Y-m-d-H-i-s') . 'backPic.' . pathinfo($url, PATHINFO_EXTENSION);
                    $file_path_back  = public_path('/residentID') . '/' . $filename_back;

                    // Save the downloaded file to the server
                    file_put_contents($file_path_back, $contents_back);
                }
            }
            if ($request->has('face')) {
                $url = $request->input('face');
                $response = Http::get($url);

                if ($response->successful()) {
                    $contents_face = $response->body();
                    $filename_face = $request->input('firstName') . '_' . $request->input('lastName') . date('Y-m-d-H-i-s') . 'face.' . pathinfo($url, PATHINFO_EXTENSION);
                    $file_path_face  = public_path('/residentID') . '/' . $filename_face;

                    // Save the downloaded file to the server
                    file_put_contents($file_path_face, $contents_face);
                }
            }


            // if ($request->file('formFile')) {
            //     $file_front = $request->file('formFile');
            //     $filename_front = $request->firstName . '_' . $request->lastName . date("Y-m-d-H-i-s") . 'frontPic.' . $file_front->getClientOriginalExtension();
            //     $file_front->move(public_path('/residentID'), $filename_front);

            // }
            // if ($request->file('formFile_2')) {
            //     $file_back = $request->file('formFile_2');
            //     $filename_back = $request->firstName . '_' . $request->lastName . date("Y-m-d-H-i-s") . 'backPic.' . $file_back->getClientOriginalExtension();
            //     $file_back->move(public_path('/residentID'), $filename_back);
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
                "isEnabled" => 0,
                'expiry' => $request->expiry,
                'face' => $filename_face,
            ]);


            $data = [
                'fullname' => $request->firstName . " " . $request->lastName . " " . $request->suffix,
                'link' => env('APP_URL') . "/verifyEmail?email=" . strtolower($request->email) . "&key=" . $request->otp,
            ];

            Mail::to($request->email)->send(new Registration($data));


            $data = [
                'success' => true,
                'message' => "success",
            ];

            return response()->json($data);
        }
        return response()->json();
    }

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
