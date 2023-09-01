<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Concerns;
use App\Models\Concern_History;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use \ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Validator;
use App\Mail\ConcernMail;
use App\Mail\DenyConcern;
use App\Mail\UpdateConcern;
use App\Mail\CloseConcern;
use Illuminate\Support\Facades\Mail;

class Concern extends Controller
{
    public function submit_concern(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'g-recaptcha-response' => 'required|captcha',
                ]
            );

            if ($validateUser->fails()) {

                $data = [
                    'success' => false,
                    'message' => "Please verify that you are not a robot.",
                ];

                return response()->json($data);
            }

            if ($request->file('file')) {
                $file_front = $request->file('file');
                $filename = $request->resident_id . '_' . "concern " . date("Y-m-d-H-i-s") . "." . $file_front->getClientOriginalExtension();
                $file_front->move(public_path('/concerns'), $filename);
            } else {
                $filename = "";
            }

            do {
                $random_number = mt_rand(1000000, 9999999);
                $formatted_number = sprintf("%07d", $random_number);
                $reference_key =  "CONCERN-" . $formatted_number;
                $count = Concerns::where('reference_key', $reference_key)->count();
            } while ($count != 0);



            Concerns::create([
                'reference_key' => $reference_key,
                'concern_type' => $request->concern_type,
                'resident_id' => $request->resident_id,
                'concern_title' => $request->concern_title,
                'concern_description' => $request->concern_description,
                'concern_photo' => $filename,
                'concern_status' => "PENDING"
            ]);
            Concern_History::create([
                'concern' => Concerns::where('resident_id', $request->resident_id)->get()->last()->concern_id,
                'concern_update_status' => "PENDING",

            ]);


            $emailSendTo = User::where('id', $request->resident_id)->first();


            $data = [
                'fullname' => $emailSendTo->first_name . " " . $emailSendTo->last_name . " " . $emailSendTo->suffix,
                'concern_title' => $request->concern_title,
                'concern_description' => $request->concern_description,
                'ref_key' => $reference_key,
            ];


            Mail::to($emailSendTo->email)->send(new ConcernMail($data));

            $message = '<p>Your concern reference key:</p><hr>
                               <h5>' . $reference_key . '</h5>
                               <hr>
                           <p>Use this reference key to track your request.</p>';


            $data = [
                'success' => "true",
                'message' => $message,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle the exception here
            $data = [
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function denyconcern(Request $request)
    {

        try {

            $password_correct = password_verify($request->password, Auth::user()->password);
            if ($password_correct) {
                $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('concern_id', $request->id)->get()->first();
                Concerns::where('concern_id', $request->id)->update([
                    'concern_status' => 'DENIED',
                    'concern_message' => $request->note
                ]);
                Concern_History::create([
                    'concern' => $request->id,
                    "concern_update_status" => "DENIED",
                    "employee_name" =>  $transactions->concern_processed_by,
                    'concern_update_title' => "DENIED CONCERN",
                    'concern_update_description' => $request->note

                ]);


                $emailSendTo =  $transactions->first_name . " " . $transactions->last_name;

                $data = [
                    'fullname' => $transactions->first_name . " " . $transactions->last_name . " " . $transactions->suffix,
                    'note' => $request->note,
                    'ref_key' => $transactions->reference_key,
                    'concern_title' => $transactions->concern_title,
                    'concern_description' => $transactions->concern_description,
                ];

                Mail::to($transactions->email)->send(new DenyConcern($data));
                $data = [
                    'success' => true,
                    'message' => 'Correct',
                    'content' =>  $transactions,
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Incorrect',
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle exceptions here
            $data = [
                'success' => false,
                'message' => $e->getMessage(), // You can customize the error message
            ];

            return response()->json($data, 500); // Use an appropriate HTTP status code
        }
    }
    public function updateConcern(Request $request)
    {

        try {
            $password_correct = password_verify($request->password, Auth::user()->password);
            if ($password_correct) {
                $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('concern_id', $request->id)->get()->first();
                Concern_History::create([
                    'concern' => $request->id,
                    "concern_update_status" => "UPDATE",
                    "employee_name" =>  $transactions->concern_processed_by,
                    'concern_update_title' => $request->title,
                    'concern_update_description' => $request->details
                ]);

                $emailSendTo =  $transactions->first_name . " " . $transactions->last_name;
                $data = [
                    'fullname' => $transactions->first_name . " " . $transactions->last_name . " " . $transactions->suffix,
                    'note' => $request->note,
                    'ref_key' => $transactions->reference_key,
                    'request_title' => $request->title,
                    'request_details' => $request->details,
                ];

                Mail::to($transactions->email)->send(new UpdateConcern($data));
                $data = [
                    'success' => true,
                    'message' => 'Correct',
                    'content' =>  $transactions,
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Incorrect',
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle exceptions here
            $data = [
                'success' => false,
                'message' => $e->getMessage(), // You can customize the error message
            ];

            return response()->json($data, 500); // Use an appropriate HTTP status code
        }
    }

    public function closeConcern(Request $request)
    {


        $password_correct = password_verify($request->password, Auth::user()->password);
        if ($password_correct) {
            $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('concern_id', $request->id)->get()->first();

            Concerns::where('concern_id', $request->id)->update([
                'concern_status' => 'DONE',
                'concern_message' => $request->note
            ]);
            Concern_History::create([
                'concern' => $request->id,
                "concern_update_status" => "DONE",
                "employee_name" =>  $transactions->concern_processed_by,
                'concern_update_title' => $request->title,
                'concern_update_description' => $request->details
            ]);

            $emailSendTo =  $transactions->first_name . " " . $transactions->last_name;

            $data = [
                'fullname' => $transactions->first_name . " " . $transactions->last_name . " " . $transactions->suffix,
                'note' => $request->note,
                'ref_key' => $transactions->reference_key,
                'request_title' => $request->title,
                'request_details' => $request->details,
            ];

            Mail::to($transactions->email)->send(new CloseConcern($data));


            $data = [
                'success' => true,
                'message' => 'Correct',
                'content' =>  $transactions,
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Incorrect',
            ];
        }

        return response()->json($data);
    }
}
