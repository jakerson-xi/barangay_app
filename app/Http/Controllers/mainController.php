<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Request_History;
use App\Models\Request_type;
use App\Models\Payment;
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


        //to reroute to id analyzer page
        if ($request->reference == "") {
            return redirect()->route('registration_id');
        }

        $ref = 'docupass_reference=' . $request->reference;
        $vault = new Vault(ENV('ID_ANALYZER'), "US");


        //if the reference is not existing or error
        if ($vault->list([$ref])['total'] == 0) {
            return redirect()->route('registration_id');
        }

        //hold the data from the id analyzer
        $vaultItems = $vault->list([$ref])['items']['0'];
        $id_number = $vaultItems['documentNumber'];


        #check if the user already registred 
        if (User::where('validID_num', $id_number)->exists()) {

            Alert::error('User Already Registered', 'The ID number already exists. If you encounter any issues during registration, please contact the barangay.')
                ->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        }



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


        if ($exist >= 1) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'Email already registred from different account')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard_Profile');
        }
        if ($new_email == $userInfo->email) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'Please enter a new email')->showConfirmButton('Confirm', '#AA0F0A');
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


        try {
            $user_auth = Auth::user();

            $coreapi = new CoreAPI(ENV('ID_ANALYZER'), "US");
            $coreapi->enableAuthentication(true, '2');
            $coreapi->verifyExpiry(true);
            $coreapi->verifyDocumentNumber($user_auth->validID_num);
            $coreapi->enableImageOutput(true, true, "url");
            $result = $coreapi->scan($request->file('formFile'), $request->file('formFile_2'), $request->file('face'));


            $full_name = $user_auth->first_name . " " . $user_auth->middle_name . " " . $user_auth->last_name;


            if (isset($result['error']['message'])) {
                $data = [
                    'error' => true,
                    'message' => $result['error']['message'],
                ];
                return response()->json($data);
            }
            //check if the ID and the face is identical
            if ($result['face']['confidence'] < 0.7) {

                $data = [
                    'error' => true,
                    'message' => "Face photo is not recognized with your ID",
                ];
                return response()->json($data);
            }


            //check if the name from the ID is same with the name of the resident
            if (levenshtein($result['result']['fullName'], $full_name) > 6) {

                $data = [
                    'error' => true,
                    'message' => "Invalid name from your ID",
                ];
                return response()->json($data);
            }

            //check if the ID NUMBER from the ID is same with the name of the resident
            if ($result['result']['documentNumber'] == $user_auth->validID_num) {

                $data = [
                    'error' => true,
                    'message' => "Please upload a new ID",
                ];
                return response()->json($data);
            }



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
            if ($request->file('face')) {
                $face = $request->file('face');
                $filename_face = $user_auth->id . '-' . $user_auth->first_name . '-' . $user_auth->last_name . '-' . date("Y-m-d-H-i-s") . '-face.' . $face->getClientOriginalExtension();
                $face->move(public_path('/residentID'), $filename_face);
            }


            $expired_date = null;

            if (isset($result['result']['expiry'])) {
                $expired_date = $result['result']['expiry'];
            }

            User::where('id',  $id)->first()->update([
                "valiID_type" => $request->type_validID,
                "validID_num" => $result['result']['documentNumber'],
                "validID_front" => $filename_front,
                "validID_back" => $filename_back,
                "face" => $filename_face,
                'expiry' =>  $expired_date
            ]);




            $data = [
                'success' => true,
                'message' => "You successfully updated your valid ID!",
            ];

            return response()->json($data);
        } catch (\Throwable $th) {
            $data = [
                'error' => true,
                'message' => $th,
            ];
            return response()->json($data);
        }
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
        if (Requests::where('resident_id', $user_auth->id)->where('request_type_id', $request_type[0]->request_type_id)->whereIn('request_status', ['Pending', 'Processing', 'Approved', 'PAID'])->count() != 0) {
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

    public function paymentList()
    {

        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();

        if (Auth::user()->role != 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }

        $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
            ->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
            ->where('id', $user_auth->id)
            ->where('request_status', 'READY FOR PAYMENT')
            ->whereNotIn('request_type.request_type_name', ['CONCERN', 'COMMUNITY TAX CERTIFICATE'])
            ->get();
        // $concern = Requests::join('users', 'users.id', '=', 'requests.resident_id')
        //     ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
        //     ->join('payment', 'payment.request_id', '=', 'requests.request_id')
        //     ->select('payment.*','users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
        //     ->where('id', $user_auth->id)
        //     ->where('request_status', 'CONFIRMED PAYMENT')
        //     ->whereNotIn('request_type.request_type_name', ['CONCERN', 'COMMUNITY TAX CERTIFICATE'])
        //     ->get();

        $concern = Payment::join('requests', 'requests.request_id', '=', 'payment.request_id')
        ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
        ->join('users', 'users.id', '=', 'requests.resident_id')
        ->where('id', $user_auth->id)
        ->where('payment_status', 'PAID')
        ->select('payment.*','users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
        ->get();

        return view("paymentList", ['user_info' => $user_info, 'transaction' => $transactions, 'paid' => $concern]);
    }


    public function payment_request($id)
    {


        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('reference_key', $id)->get($id);


        return view("viewRFP", ['user_info' => $user_info, 'request' => $request]);
    }

    public function paid($id)
    {
        $user_auth = Auth::user();
        $user_info = DB::table('users')->where('id', $user_auth->id)->get();
        $request_list = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('reference_key', $id)->get();

        $request = $request_list->first();
        $paymentDetails = Payment::where('request_id', $request->request_id)->where('payment_status', 'PAID')->get()->last();


        return view("paid", ['user_info' => $user_info, 'request' => $request_list, 'paymentDetails' => $paymentDetails]);
    }


    public function paymongo($id, $mode)
    {


        $service_charge = 0;

        if ($mode == "gcash") {
            $service_charge = 0.0256;
        }
        if ($mode == "grab_pay") {
            $service_charge = 0.0225;
        }
        if ($mode == "paymaya") {
            $service_charge = 0.021;
        }
        $request = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
            ->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
            ->where('reference_key', $id)->get()
            ->first();

        if ($request == null) {

            return redirect()->route('userDashboard');
        }
        if ($request->request_status == "READY FOR PAYMENT") {

            $fullname = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
                'body' => '{
            "data": {
                "attributes": {
                    "billing":{
                        "name":"' . $fullname . '",
                        "email":"' . $request->email . '",
                        "phone":"' . $request->mobile_num . '"},
                    "send_email_receipt": true,
                    "show_description": true,
                    "show_line_items": true,
                    "description": "Barangay South Signal Village Online Request (including the ' . $service_charge * 100 . '% service charge)",
                    "line_items": [
                        {
                            "currency": "PHP",
                            "amount":' . intval(($request->price * $service_charge + $request->price) * 100)  . ',
                            "name": "' . str_replace("\r\n", " ", $request->request_type_name) . "(" . $request->request_description . ')",
                            "quantity": 1,
                            "description": "' . $request->request_description . '"
                        }
                    ],
                    "reference_number": "' . $request->reference_key . '",
                    "payment_method_types": ["' . $mode . '"],
                    "success_url": "' . ENV('APP_URL') . '/paymongo_success/' . $id . '",
                    "cancel_url":"' . ENV('APP_URL') . '/paymongo_failed/' . $id . '"
                    
                }
            }
        }',
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF91RmF5VmQ0OW1RYU5jRG9FZEVyWU12aWY6',
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);
            // Access the 'checkout_url' attribute        
            $checkoutUrl = $responseData['data']['attributes']['checkout_url'];

            if (Payment::where('request_id', $request->request_id)->where('payment_status', 'PENDING PAYMENT')->exists() == false) {
                Payment::create([
                    'request_id' => $request->request_id,
                    'resident_id' => $request->id,
                    'payment_ref' => $responseData['data']['id'],
                    'payment_status' => 'PENDING PAYMENT',
                    'payment_method' => '',
                    'request_price' => $request->price,
                    'service_charge' => ($request->price * $service_charge),
                ]);
            } else {
                Payment::where('request_id', $request->request_id)->get()->first()->update([
                    'payment_ref' => $responseData['data']['id'],
                ]);
            }

            return redirect($checkoutUrl);
        }

        return redirect()->route('userDashboard');
    }

    public function paymongo_failed($id)
    {

        $info_request = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
            ->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
            ->where('reference_key', $id)->get()
            ->first();


        if ($info_request->request_status == 'READY FOR PAYMENT') {
            $ref = Payment::where('request_id', $info_request->request_id)->first()->payment_ref;


            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.paymongo.com/v1/checkout_sessions/' . $ref . '', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF91RmF5VmQ0OW1RYU5jRG9FZEVyWU12aWY6',
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);


            $request = Requests::where('reference_key', $id)->first();

            if ($request) {
                // Modify the request_status field
                $request->request_status = 'PAID';

                // Save the changes to the database
                $request->save();
            }

            Payment::create([
                'request_id' => $request->request_id,
                "resident_id" => $info_request->id,
                'payment_ref' => $responseData['data']['id'],
                'payment_status' => 'FAILED PAYMENT',
                'payment_method' => $responseData['data']['attributes']['payment_method_used'],
                'request_price' => $request->price,
                'service_charge' => $request->price * 0.025,
            ]);

            Alert::error('PAYMENT UNSUCCESSFUL', 'Sorry, your payment could not be processed. Please check your payment details and try again.')->showConfirmButton('OK', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        Alert::error('UNAUTHORIZED PAGE', '')->showConfirmButton('Confirm', '#AA0F0A');

        return redirect()->route('userDashboard');
    }

    public function paymongo_success($id)
    {



        $info_request = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
            ->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
            ->where('reference_key', $id)->get()
            ->first();


        if ($info_request->request_status == 'READY FOR PAYMENT') {
            $ref = Payment::where('request_id', $info_request->request_id)->first()->payment_ref;


            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.paymongo.com/v1/checkout_sessions/' . $ref . '', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF91RmF5VmQ0OW1RYU5jRG9FZEVyWU12aWY6',
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            // DD($responseData['data']['attributes']['payment_method_used']);
            $request = Requests::where('reference_key', $id)->first();

            if ($request) {
                // Modify the request_status field
                $request->request_status = 'PAID';

                // Save the changes to the database
                $request->save();
            }

            Request_History::create([
                'request_id' => $request->request_id,
                "processed_by" =>  "Online",
                'request_id' => $request->request_id,
                'request_status' => 'PAID',
            ]);


            $service_charge = 0;

            if ($responseData['data']['attributes']['payment_method_used'] == "gcash") {
                $service_charge = 0.0256;
            }
            if ($responseData['data']['attributes']['payment_method_used'] == "grab_pay") {
                $service_charge = 0.0225;
            }
            if ($responseData['data']['attributes']['payment_method_used'] == "paymaya") {
                $service_charge = 0.021;
            }

            Payment::create([
                'request_id' => $request->request_id,
                "resident_id" => $info_request->id,
                'payment_ref' => $responseData['data']['attributes']['payments'][0]['id'],
                'payment_status' => 'PAID',
                'payment_method' => $responseData['data']['attributes']['payment_method_used'],
                'request_price' => $request->price,
                'service_charge' => $request->price * $service_charge,
            ]);

            Alert::SUCCESS('PAYMENT SUCCESSFUL', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('userDashboard');
        }
        Alert::error('UNAUTHORIZED PAGE', '')->showConfirmButton('Confirm', '#AA0F0A');

        return redirect()->route('userDashboard');
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
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
            ->where('reference_key', $id)->get($id);

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
