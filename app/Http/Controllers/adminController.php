<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Requests;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Request_type;
use App\Models\Request_History;
use App\Models\Concern_History;
use App\Models\Concerns;
use App\Models\Web_App;
use App\Models\Payment;
use App\Models\Visitor;
use Carbon\Carbon;
use App\Mail\OnsiteReceipt;
use Illuminate\Support\Facades\Mail;

class adminController extends Controller
{


    public function viewPayment($ref)
    {

        $user = Auth::user();
        $admin_info = User::where('id', $user->id)->get();

        $transaction_info = Payment::where('payment_ref', $ref)
            ->join('requests', 'requests.request_id', '=', 'payment.request_id')
            ->join('users', 'users.id', '=', 'payment.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
            ->select(
                'payment.*',
                'request_type.*',
                'users.*',
                'requests.*',
                'payment.created_at as payment_date',
                'requests.created_at as request_date'
            )
            ->first();


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.paymongo.com/v1/payments/' . $ref . '', [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF91RmF5VmQ0OW1RYU5jRG9FZEVyWU12aWY6',
            ],
        ]);

        $responseData = json_decode($response->getBody(), true)['data']['attributes']['billing'];

        return view('admin/processOnlinePayment', ['admin_info' => $admin_info, 'payment' => $transaction_info, 'billing' => $responseData]);
    }

    public function deact_admin(Request $request)
    {
        $user_status =  DB::table('users')->where('id', $request->id)->first();

        if ($user_status->isEnabled ==  0) {
            User::where('id', $request->id)->update(['isEnabled' => 1]);
            alert()->success('SUCCESSFULLY ACTIVATED', '')->showConfirmButton('Confirm', '#AA0F0A');
        } elseif ($user_status->isEnabled ==  1) {
            User::where('id', $request->id)->update(['isEnabled' => 0]);
            alert()->success('SUCCESSFULLY DEACTIVATED', '')->showConfirmButton('Confirm', '#AA0F0A');
        }

        // $user = Auth::user();

        // $admin_info = DB::table('users')->where('id', $user->id)->get();

        // $list_info = DB::table('users')
        //     ->whereNot('role', 'resident')
        //     ->whereNot('id', $user->id)
        //     ->where('isEnabled', 1)
        //     ->orderByDesc('id')->get();

        return redirect()->route('listemployee');
    }
    public function dashboard_employee()
    {

        $user = Auth::user();
        $admin_info = User::where('id', $user->id)->get();

        $list_info = DB::table('users')
            ->whereNot('role', 'resident')
            ->where('isEnabled', 1)
            ->orderByDesc('id')->get();


        $ages = array(
            '18-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60-69' => 0,
            '70+' => 0
        );

        $num_res = User::whereNot('role', 'resident')->get()->count();
        $num_res_active = User::whereNot('role', 'resident')->where('isEnabled', 1)->get()->count();
        $num_res_inactive  = User::whereNot('role', 'resident')->where('isEnabled', 0)->get()->count();
        $visit_num  = Visitor::get()->count();
        $male = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Male')->get()->count();
        $female = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Female')->get()->count();
        $user_age = User::where('role', 'resident')
            ->where('isEnabled', 1)
            ->select('birthdate')
            ->get()
            ->map(function ($user) {
                $user->age = Carbon::parse($user->birthdate)->age;
                return $user;
            });

        foreach ($user_age as $user) {
            if ($user->age >= 18 && $user->age <= 29) {
                $ages['18-29']++;
            } elseif ($user->age >= 30 && $user->age <= 39) {
                $ages['30-39']++;
            } elseif ($user->age >= 40 && $user->age <= 49) {
                $ages['40-49']++;
            } elseif ($user->age >= 50 && $user->age <= 59) {
                $ages['50-59']++;
            } elseif ($user->age >= 60 && $user->age <= 69) {
                $ages['60-69']++;
            } elseif ($user->age >= 70) {
                $ages['70+']++;
            }
        }
        // Group visitors by day
        $visitorsByDay = DB::table('visitor')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->get();

        // Group visitors by week
        $visitorsByWeek = DB::table('visitor')
            ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
            ->groupBy('week')
            ->get();

        // Group visitors by month
        $visitorsByMonth = DB::table('visitor')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('year', 'month')
            ->get();

        // Group visitors by year
        $visitorsByYear = DB::table('visitor')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();


        $days = [];
        $dayTotals = [];
        $weeks = [];
        $weekTotals = [];
        $months = [];
        $monthTotals = [];
        $years = [];
        $yearTotals = [];

        foreach ($visitorsByDay as $visitor) {
            array_push($days, $visitor->date);
            array_push($dayTotals, $visitor->total);
        }

        foreach ($visitorsByWeek as $visitor) {

            array_push($weeks, $visitor->week);
            array_push($weekTotals, $visitor->total);
        }

        foreach ($visitorsByMonth as $visitor) {
            $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
            array_push($months, $month);
            array_push($monthTotals, $visitor->total);
        }

        foreach ($visitorsByYear as $visitor) {
            array_push($years, $visitor->year);
            array_push($yearTotals, $visitor->total);
        }

        $uniqueStreetsCount = DB::table('users')->where('role', 'resident')
            ->selectRaw('address_street, count(*) as count')
            ->groupBy('address_street')
            ->get();


        $street = [];
        $streetTotals = [];
        foreach ($uniqueStreetsCount as $streets) {
            array_push($street, $streets->address_street);
            array_push($streetTotals, $streets->count);
        }

        $requests = DB::table('requests')
            ->select('employee_name', DB::raw('((SUM(CASE WHEN request_status = "DONE" THEN 1 ELSE 0 END) + SUM(CASE WHEN request_status = "DENIED" THEN 1 ELSE 0 END) )/COUNT(*))*100 AS computation'))
            ->groupBy('employee_name')
            ->get();

        $concerns = DB::table('concern')
            ->select('concern_processed_by', DB::raw('((SUM(CASE WHEN concern_status = "DONE" THEN 1 ELSE 0 END) + SUM(CASE WHEN concern_status = "DENIED" THEN 1 ELSE 0 END) )/COUNT(*))*100 AS computation'))
            ->groupBy('concern_processed_by')
            ->get();

        return view('admin/dash_employee', [
            'requests' => $requests,
            'concerns' => $concerns,
            'admin_info' => $admin_info,
            'list_info' => $list_info,
            'num_res' => $num_res,
            'num_res_active'  => $num_res_active,
            'num_res_inactive' => $num_res_inactive,
            'visit_num' => $visit_num,
            'male' => (($male) / ($male + $female)) * 100,
            'female' => (($female) / ($male + $female)) * 100,
            'labels_age' => array_keys($ages),
            'data_age' => array_values($ages),
            "days"  => array_values($days),
            "dayTotals" => array_values($dayTotals),
            "weeks" => array_values($weeks),
            "weekTotals" => array_values($weekTotals),
            'months'  => array_values($months),
            "monthTotals" => array_values($monthTotals),
            "years" => array_values($years),
            "yearTotals" => array_values($yearTotals),
            'street' => array_values($street),
            'streetTotals' => array_values($streetTotals),
        ]);
    }
    public function dashboard_resident()
    {
        $user = Auth::user();
        $admin_info = User::where('id', $user->id)->get();

        $ages = array(
            '18-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60-69' => 0,
            '70+' => 0
        );

        $num_res = User::where('role', 'resident')->get()->count();
        $num_res_active = User::where('role', 'resident')->where('isEnabled', 1)->get()->count();
        $num_res_inactive  = User::where('role', 'resident')->where('isEnabled', 0)->get()->count();
        $visit_num  = Visitor::get()->count();
        $male = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Male')->get()->count();
        $female = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Female')->get()->count();
        $user_age = User::where('role', 'resident')
            ->where('isEnabled', 1)
            ->select('birthdate')
            ->get()
            ->map(function ($user) {
                $user->age = Carbon::parse($user->birthdate)->age;
                return $user;
            });

        foreach ($user_age as $user) {
            if ($user->age >= 18 && $user->age <= 29) {
                $ages['18-29']++;
            } elseif ($user->age >= 30 && $user->age <= 39) {
                $ages['30-39']++;
            } elseif ($user->age >= 40 && $user->age <= 49) {
                $ages['40-49']++;
            } elseif ($user->age >= 50 && $user->age <= 59) {
                $ages['50-59']++;
            } elseif ($user->age >= 60 && $user->age <= 69) {
                $ages['60-69']++;
            } elseif ($user->age >= 70) {
                $ages['70+']++;
            }
        }
        // Group visitors by day
        $visitorsByDay = DB::table('visitor')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->get();

        // Group visitors by week
        $visitorsByWeek = DB::table('visitor')
            ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
            ->groupBy('week')
            ->get();

        // Group visitors by month
        $visitorsByMonth = DB::table('visitor')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('year', 'month')
            ->get();

        // Group visitors by year
        $visitorsByYear = DB::table('visitor')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();


        $days = [];
        $dayTotals = [];
        $weeks = [];
        $weekTotals = [];
        $months = [];
        $monthTotals = [];
        $years = [];
        $yearTotals = [];

        foreach ($visitorsByDay as $visitor) {
            array_push($days, $visitor->date);
            array_push($dayTotals, $visitor->total);
        }

        foreach ($visitorsByWeek as $visitor) {

            array_push($weeks, $visitor->week);
            array_push($weekTotals, $visitor->total);
        }

        foreach ($visitorsByMonth as $visitor) {
            $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
            array_push($months, $month);
            array_push($monthTotals, $visitor->total);
        }

        foreach ($visitorsByYear as $visitor) {
            array_push($years, $visitor->year);
            array_push($yearTotals, $visitor->total);
        }

        $uniqueStreetsCount = DB::table('users')->where('role', 'resident')
            ->selectRaw('address_street, count(*) as count')
            ->groupBy('address_street')
            ->get();


        $street = [];
        $streetTotals = [];
        foreach ($uniqueStreetsCount as $streets) {
            array_push($street, $streets->address_street);
            array_push($streetTotals, $streets->count);
        }


        return view('admin/dash_resident', [
            'admin_info' => $admin_info,
            'num_res' => $num_res,
            'num_res_active'  => $num_res_active,
            'num_res_inactive' => $num_res_inactive,
            'visit_num' => $visit_num,
            'male' => (($male) / ($male + $female)) * 100,
            'female' => (($female) / ($male + $female)) * 100,
            'labels_age' => array_keys($ages),
            'data_age' => array_values($ages),
            "days"  => array_values($days),
            "dayTotals" => array_values($dayTotals),
            "weeks" => array_values($weeks),
            "weekTotals" => array_values($weekTotals),
            'months'  => array_values($months),
            "monthTotals" => array_values($monthTotals),
            "years" => array_values($years),
            "yearTotals" => array_values($yearTotals),
            'street' => array_values($street),
            'streetTotals' => array_values($streetTotals),
        ]);
    }
    public function dashboard()
    {

        $user = Auth::user();
        $admin_info = User::where('id', $user->id)->get();
        if ($user->role == 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {

            if ($user->role == 'Barangay Secretary'  || $user->role == 'Request Manager' || $user->role == 'Concern Manager') {
                $name = $admin_info->first()->first_name . ' ' . $admin_info->first()->last_name;

                $requestCounts = DB::table('requests')
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->groupBy('request_status')
                    ->get();
                $requestCountsToday = DB::table('requests')
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('request_status')
                    ->get();

                $concernCounts = DB::table('concern')
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->groupBy('concern_status')
                    ->get();
                $concernCountsToday = DB::table('concern')
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('concern_status')
                    ->get();

                $requestCounts_employee = DB::table('requests')->where('employee_name', $name)
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->groupBy('request_status')
                    ->get();

                $requestCountsToday_employee = DB::table('requests')->where('employee_name', $name)
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('request_status')
                    ->get();
                $concernCounts_employee = DB::table('concern')->where('concern_processed_by', $name)
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->groupBy('concern_status')
                    ->get();
                $concernCountsToday_employee = DB::table('concern')->where('concern_processed_by', $name)
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('concern_status')
                    ->get();

                // Group visitors by day
                $requestByDay = DB::table('requests')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();

                // Group visitors by week
                $requestByWeek = DB::table('requests')
                    ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
                    ->groupBy('week')
                    ->get();

                // Group visitors by month
                $requestByMonth = DB::table('requests')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->groupBy('year', 'month')
                    ->get();

                // Group visitors by year
                $requestByYear = DB::table('requests')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();

                $request_type = DB::table('requests')->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
                    ->select('request_type_name', DB::raw('count(*) as count'))
                    ->groupBy('request_type_name')
                    ->get();


                $street = [];
                $streetTotals = [];
                foreach ($request_type as $streets) {
                    array_push($street, $streets->request_type_name);
                    array_push($streetTotals, $streets->count);
                }


                $days = [];
                $dayTotals = [];
                $weeks = [];
                $weekTotals = [];
                $months = [];
                $monthTotals = [];
                $years = [];
                $yearTotals = [];

                foreach ($requestByDay as $visitor) {
                    array_push($days, $visitor->date);
                    array_push($dayTotals, $visitor->total);
                }

                foreach ($requestByWeek as $visitor) {

                    array_push($weeks, $visitor->week);
                    array_push($weekTotals, $visitor->total);
                }

                foreach ($requestByMonth as $visitor) {
                    $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
                    array_push($months, $month);
                    array_push($monthTotals, $visitor->total);
                }

                foreach ($requestByYear as $visitor) {
                    array_push($years, $visitor->year);
                    array_push($yearTotals, $visitor->total);
                }

                // Group visitors by day
                $concernByDay = DB::table('concern')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();

                // Group visitors by week
                $concernByWeek = DB::table('concern')
                    ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
                    ->groupBy('week')
                    ->get();

                // Group visitors by month
                $concernByMonth = DB::table('concern')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->groupBy('year', 'month')
                    ->get();

                // Group visitors by year
                $concernByYear = DB::table('concern')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();

                $con_type = DB::table('concern')
                    ->select('concern_type', DB::raw('count(*) as count'))
                    ->groupBy('concern_type')
                    ->get();

                $days_con = [];
                $dayTotals_con = [];
                $weeks_con = [];
                $weekTotals_con = [];
                $months_con = [];
                $monthTotals_con = [];
                $years_con = [];
                $yearTotals_con = [];
                $concern_type = [];
                $concern_type_count = [];

                foreach ($concernByDay as $visitor) {
                    array_push($days_con, $visitor->date);
                    array_push($dayTotals_con, $visitor->total);
                }

                foreach ($concernByWeek as $visitor) {

                    array_push($weeks_con, $visitor->week);
                    array_push($weekTotals_con, $visitor->total);
                }

                foreach ($concernByMonth as $visitor) {
                    $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
                    array_push($months_con, $month);
                    array_push($monthTotals_con, $visitor->total);
                }

                foreach ($concernByYear as $visitor) {
                    array_push($years_con, $visitor->year);
                    array_push($yearTotals_con, $visitor->total);
                }

                foreach ($con_type as $visitor) {
                    array_push($concern_type, $visitor->concern_type);
                    array_push($concern_type_count, $visitor->count);
                }

                return view('admin/dashboard_secretary', [
                    'admin_info' => $admin_info,
                    'req_count' => $requestCounts,
                    'requestCountsToday' => $requestCountsToday,
                    'con_count' => $concernCounts,
                    'conCountsToday' => $concernCountsToday,
                    'req_count_emp' => $requestCounts_employee,
                    'requestCountsToday_emp' => $requestCountsToday_employee,
                    'con_count_emp' => $concernCounts_employee,
                    'conCountsToday_emp' => $concernCountsToday_employee,
                    "days"  => array_values($days),
                    "dayTotals" => array_values($dayTotals),
                    "weeks" => array_values($weeks),
                    "weekTotals" => array_values($weekTotals),
                    'months'  => array_values($months),
                    "monthTotals" => array_values($monthTotals),
                    "years" => array_values($years),
                    "yearTotals" => array_values($yearTotals),
                    'street' => array_values($street),
                    'streetTotals' => array_values($streetTotals),

                    "days_con"  => array_values($days_con),
                    "dayTotals_con" => array_values($dayTotals_con),
                    "weeks_con" => array_values($weeks_con),
                    "weekTotals_con" => array_values($weekTotals_con),
                    'months_con'  => array_values($months_con),
                    "monthTotals_con" => array_values($monthTotals_con),
                    "years_con" => array_values($years_con),
                    "yearTotals_con" => array_values($yearTotals_con),
                    'concern_type' => array_values($concern_type),
                    'concern_type_count' => array_values($concern_type_count),
                ]);
            }


            if ($user->role == 'Administrator') {
                // $requests = DB::table('requests')
                // ->select('employee_name', DB::raw('((SUM(CASE WHEN request_status = "DONE" THEN 1 ELSE 0 END) + SUM(CASE WHEN request_status = "DENIED" THEN 1 ELSE 0 END) )/COUNT(*))*100 AS computation'))
                // ->groupBy('employee_name')
                // ->get();

                // $concerns = DB::table('concern')
                // ->select('concern_processed_by', DB::raw('((SUM(CASE WHEN concern_status = "DONE" THEN 1 ELSE 0 END) + SUM(CASE WHEN concern_status = "DENIED" THEN 1 ELSE 0 END) )/COUNT(*))*100 AS computation'))
                // ->groupBy('concern_processed_by')
                // ->get();


                $ages = array(
                    '18-29' => 0,
                    '30-39' => 0,
                    '40-49' => 0,
                    '50-59' => 0,
                    '60-69' => 0,
                    '70+' => 0
                );

                $num_res = User::where('role', 'resident')->get()->count();
                $num_res_active = User::where('role', 'resident')->where('isEnabled', 1)->get()->count();
                $num_res_inactive  = User::where('role', 'resident')->where('isEnabled', 0)->get()->count();
                $visit_num  = Visitor::get()->count();
                $male = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Male')->get()->count();
                $female = User::where('role', 'resident')->where('isEnabled', 1)->where('gender', 'Female')->get()->count();
                $user_age = User::where('role', 'resident')
                    ->where('isEnabled', 1)
                    ->select('birthdate')
                    ->get()
                    ->map(function ($user) {
                        $user->age = Carbon::parse($user->birthdate)->age;
                        return $user;
                    });

                foreach ($user_age as $user) {
                    if ($user->age >= 18 && $user->age <= 29) {
                        $ages['18-29']++;
                    } elseif ($user->age >= 30 && $user->age <= 39) {
                        $ages['30-39']++;
                    } elseif ($user->age >= 40 && $user->age <= 49) {
                        $ages['40-49']++;
                    } elseif ($user->age >= 50 && $user->age <= 59) {
                        $ages['50-59']++;
                    } elseif ($user->age >= 60 && $user->age <= 69) {
                        $ages['60-69']++;
                    } elseif ($user->age >= 70) {
                        $ages['70+']++;
                    }
                }
                // Group visitors by day
                $visitorsByDay = DB::table('visitor')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();

                // Group visitors by week
                $visitorsByWeek = DB::table('visitor')
                    ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
                    ->groupBy('week')
                    ->get();

                // Group visitors by month
                $visitorsByMonth = DB::table('visitor')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->groupBy('year', 'month')
                    ->get();

                // Group visitors by year
                $visitorsByYear = DB::table('visitor')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();


                $days = [];
                $dayTotals = [];
                $weeks = [];
                $weekTotals = [];
                $months = [];
                $monthTotals = [];
                $years = [];
                $yearTotals = [];

                foreach ($visitorsByDay as $visitor) {
                    array_push($days, $visitor->date);
                    array_push($dayTotals, $visitor->total);
                }

                foreach ($visitorsByWeek as $visitor) {

                    array_push($weeks, $visitor->week);
                    array_push($weekTotals, $visitor->total);
                }

                foreach ($visitorsByMonth as $visitor) {
                    $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
                    array_push($months, $month);
                    array_push($monthTotals, $visitor->total);
                }

                foreach ($visitorsByYear as $visitor) {
                    array_push($years, $visitor->year);
                    array_push($yearTotals, $visitor->total);
                }

                $uniqueStreetsCount = DB::table('users')->where('role', 'resident')
                    ->selectRaw('address_street, count(*) as count')
                    ->groupBy('address_street')
                    ->get();


                $street = [];
                $streetTotals = [];
                foreach ($uniqueStreetsCount as $streets) {
                    array_push($street, $streets->address_street);
                    array_push($streetTotals, $streets->count);
                }


                return view('admin/dashboard_admin', [
                    'admin_info' => $admin_info,
                    'num_res' => $num_res,
                    'num_res_active'  => $num_res_active,
                    'num_res_inactive' => $num_res_inactive,
                    'visit_num' => $visit_num,
                    'male' => (($male) / ($male + $female)) * 100,
                    'female' => (($female) / ($male + $female)) * 100,
                    'labels_age' => array_keys($ages),
                    'data_age' => array_values($ages),
                    "days"  => array_values($days),
                    "dayTotals" => array_values($dayTotals),
                    "weeks" => array_values($weeks),
                    "weekTotals" => array_values($weekTotals),
                    'months'  => array_values($months),
                    "monthTotals" => array_values($monthTotals),
                    "years" => array_values($years),
                    "yearTotals" => array_values($yearTotals),
                    'street' => array_values($street),
                    'streetTotals' => array_values($streetTotals),
                ]);
            }

            if ($user->role == 'Barangay Captain') {


                $requestCounts = DB::table('requests')
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->groupBy('request_status')
                    ->get();
                $requestCountsToday = DB::table('requests')
                    ->select('request_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('request_status')
                    ->get();

                $concernCounts = DB::table('concern')
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->groupBy('concern_status')
                    ->get();
                $concernCountsToday = DB::table('concern')
                    ->select('concern_status', DB::raw('count(*) as count'))
                    ->whereDate('created_at', '=', DB::raw('CURDATE()'))
                    ->groupBy('concern_status')
                    ->get();


                $requestByDay = DB::table('requests')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();

                // Group visitors by week
                $requestByWeek = DB::table('requests')
                    ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
                    ->groupBy('week')
                    ->get();

                // Group visitors by month
                $requestByMonth = DB::table('requests')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->groupBy('year', 'month')
                    ->get();

                // Group visitors by year
                $requestByYear = DB::table('requests')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();

                $request_type = DB::table('requests')->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
                    ->select('request_type_name', DB::raw('count(*) as count'))
                    ->groupBy('request_type_name')
                    ->get();


                $req_type = [];
                $req_typeTotals = [];
                foreach ($request_type as $streets) {
                    array_push($req_type, $streets->request_type_name);
                    array_push($req_typeTotals, $streets->count);
                }
                $days = [];
                $dayTotals = [];
                $weeks = [];
                $weekTotals = [];
                $months = [];
                $monthTotals = [];
                $years = [];
                $yearTotals = [];

                foreach ($requestByDay as $visitor) {
                    array_push($days, $visitor->date);
                    array_push($dayTotals, $visitor->total);
                }

                foreach ($requestByWeek as $visitor) {

                    array_push($weeks, $visitor->week);
                    array_push($weekTotals, $visitor->total);
                }

                foreach ($requestByMonth as $visitor) {
                    $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
                    array_push($months, $month);
                    array_push($monthTotals, $visitor->total);
                }

                foreach ($requestByYear as $visitor) {
                    array_push($years, $visitor->year);
                    array_push($yearTotals, $visitor->total);
                }

                $concernByDay = DB::table('concern')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();


                $concernByWeek = DB::table('concern')
                    ->select(DB::raw("WEEK(created_at, 3) as week"), DB::raw('count(*) as total'))
                    ->groupBy('week')
                    ->get();

                $concernByMonth = DB::table('concern')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->groupBy('year', 'month')
                    ->get();


                $concernByYear = DB::table('concern')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();

                $con_type = DB::table('concern')
                    ->select('concern_type', DB::raw('count(*) as count'))
                    ->groupBy('concern_type')
                    ->get();

                $days_con = [];
                $dayTotals_con = [];
                $weeks_con = [];
                $weekTotals_con = [];
                $months_con = [];
                $monthTotals_con = [];
                $years_con = [];
                $yearTotals_con = [];
                $concern_type = [];
                $concern_type_count = [];

                foreach ($concernByDay as $visitor) {
                    array_push($days_con, $visitor->date);
                    array_push($dayTotals_con, $visitor->total);
                }

                foreach ($concernByWeek as $visitor) {

                    array_push($weeks_con, $visitor->week);
                    array_push($weekTotals_con, $visitor->total);
                }

                foreach ($concernByMonth as $visitor) {
                    $month = date('M Y', strtotime($visitor->year . '-' . $visitor->month . '-01'));
                    array_push($months_con, $month);
                    array_push($monthTotals_con, $visitor->total);
                }

                foreach ($concernByYear as $visitor) {
                    array_push($years_con, $visitor->year);
                    array_push($yearTotals_con, $visitor->total);
                }

                foreach ($con_type as $visitor) {
                    array_push($concern_type, $visitor->concern_type);
                    array_push($concern_type_count, $visitor->count);
                }

                return view('admin/dash', [
                    'admin_info' => $admin_info,
                    'req_count' => $requestCounts,
                    'requestCountsToday' => $requestCountsToday,
                    'con_count' => $concernCounts,
                    'conCountsToday' => $concernCountsToday,
                    "days"  => array_values($days),
                    "dayTotals" => array_values($dayTotals),
                    "weeks" => array_values($weeks),
                    "weekTotals" => array_values($weekTotals),
                    'months'  => array_values($months),
                    "monthTotals" => array_values($monthTotals),
                    "years" => array_values($years),
                    "yearTotals" => array_values($yearTotals),
                    'street' => array_values($req_type),
                    'streetTotals' => array_values($req_typeTotals),

                    "days_con"  => array_values($days_con),
                    "dayTotals_con" => array_values($dayTotals_con),
                    "weeks_con" => array_values($weeks_con),
                    "weekTotals_con" => array_values($weekTotals_con),
                    'months_con'  => array_values($months_con),
                    "monthTotals_con" => array_values($monthTotals_con),
                    "years_con" => array_values($years_con),
                    "yearTotals_con" => array_values($yearTotals_con),
                    'concern_type' => array_values($concern_type),
                    'concern_type_count' => array_values($concern_type_count),
                ]);
            }
            if ($user->role == 'Barangay Treasurer') {
                return view('admin/dashboard_treasurer', [
                    'admin_info' => $admin_info,
                ]);
            }
        }
    }

    public function adminPortal()
    {
        return view('admin/adminLogin');
    }

    public function addAdmin(Request $request)
    {

        if ($request->file('profilePic')) {
            $file = $request->file('profilePic');
            $filename = $request->first_name . '_' . $request->last_name . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminID'), $filename);
        }
        if (User::where('mobile_num', $request->number)->exists()) {
            Alert::error('MOBILE ALREADY EXIST', 'Enter a new mobile number');
        } elseif (User::where('email', $request->email)->exists()) {
            Alert::error('EMAIL ALREADY EXIST', 'Enter a new email');
        } else {
            User::create([
                "first_name" => strtoupper($request->first_name),
                "middle_name" => strtoupper($request->middle_name),
                "last_name" => strtoupper($request->last_name),
                "suffix" =>  strtoupper($request->suffix),
                "gender" => $request->gender,
                "marital_status" =>  $request->marital_status,
                "nationality" =>  $request->nationality,
                "birthdate" =>  $request->birthdate,
                "place_birth" =>  strtoupper($request->place_birth),
                "address_unitNo" =>  strtoupper($request->address_unitNo),
                "address_houseNo" =>  strtoupper($request->address_houseNo),
                "address_street" =>  strtoupper($request->address_street),
                "address_purok" =>  strtoupper($request->address_purok),
                "email" =>  strtolower($request->email),
                "validID_num" => strtoupper($request->validID_num),
                "mobile_num" =>  $request->mobile_num,
                "role" =>  $request->role,
                "password" => Hash::make($request->password),
                "profilePic" => $filename,
                "isEnabled" => 1
            ]);
            Alert::success(strtoupper($request->role) . ' ' . ' ACCOUNT SUCCESSFULLY CREATED', 'You successfully added new account ')->showConfirmButton('Confirm', '#AA0F0A');;
        }
        return back();
    }

    public function addEmployee()
    {

        $user = Auth::user();
        if ($user->role != 'Administrator') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            return view('admin/addEmployee', ['admin_info' => $admin_info]);
        }
    }
    public function loginAdmin(Request $request)
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

                // alert()->error('Captcha Error','Please verify that you are not a robot.')->showConfirmButton('Confirm', '#AA0F0A');

                // toast('Please verify that you are not a robot.','error');
                return redirect()->route('adminPortal');
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                alert()->error('LOG-IN FAILED', 'Email & Password does not match with our record.')->showConfirmButton('Confirm', '#AA0F0A');;
                response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
                return redirect()->route('adminPortal');
            }



            $user = User::where('email', $request->email)->first();

            if ($user->isEnabled == 0) {
                alert()->error('LOG-IN FAILED', 'Your account has been deactivated.')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->back();
            }

            if ($user->role == 'resident') {
                alert()->error('LOG-IN FAILED', 'UNAUTHORIZE')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->back();
            }
            response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            alert()->success('WELCOME', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('adminDashboard');
            dd($user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function listemployee(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'Administrator' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();

            $list_info = DB::table('users')
                ->whereNot('role', 'resident')
                ->whereNot('id', $user->id)
                ->where('isEnabled', 1)
                ->orderByDesc('id')->get();
            return view('admin/viewEmployee', ['list_info' => $list_info, 'admin_info' => $admin_info]);
        }
    }

    public function listresident()
    {
        $user = Auth::user();

        $admin_info = DB::table('users')->where('id', $user->id)->get();

        if ($user->role != 'Administrator' && $user->role != 'Barangay Secretary' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {

            $list_info = DB::table('users')->where('role', 'resident')->where('isEnabled', 1)->orderByDesc('id')->get();
            return view('admin/viewResident', ['list_info' => $list_info, 'admin_info' => $admin_info]);
        }
    }

    public function view_Employee(Request $request, $id)
    {
        $user = Auth::user();

        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $target = DB::table('users')->where('id', $id)->get();

        if ($user->role != 'Administrator' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            return view('admin/employeeAccount', ['target_info' => $target, 'admin_info' => $admin_info]);
        }
    }

    public function view_Resident(Request $request, $id)
    {
        $user = Auth::user();

        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $target = DB::table('users')->where('id', $id)->get();

        if ($user->role != 'Administrator' && $user->role != 'Barangay Secretary' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            return view('admin/residentAccount', ['target_info' => $target, 'admin_info' => $admin_info]);
        }
    }

    public function edit_Employee(Request $request, $id)
    {
        $user = Auth::user();

        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $target = DB::table('users')->where('id', $id)->get();

        if ($user->role != 'Administrator') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            return view('admin/editEmployee', ['target_info' => $target, 'admin_info' => $admin_info]);
        }
    }

    public function deact(Request $request)
    {

        $user = Auth::user();
        $user_status =  DB::table('users')->where('id', $request->id)->first();


        // Verify the password
        if (Hash::check($request->password, $user->password)) {
            if ($user_status->isEnabled ==  0) {
                User::where('id', $request->id)->update(['isEnabled' => 1]);
            } elseif ($user_status->isEnabled ==  1) {
                User::where('id', $request->id)->update(['isEnabled' => 0]);
            }
            return response()->json(['success' => true]);
        } else {
            // Passwords don't match; return an error response
            return response()->json(['success' => false, 'message' => 'Invalid password']);
        }

        // if ($user_status->isEnabled ==  0) {
        //     User::where('id', $request->id)->update(['isEnabled' => 1]);
        //     alert()->success('SUCCESSFULLY ACTIVATED', '')->showConfirmButton('Confirm', '#AA0F0A');
        // } elseif ($user_status->isEnabled ==  1) {
        //     User::where('id', $request->id)->update(['isEnabled' => 0]);
        //     alert()->success('SUCCESSFULLY DEACTIVATED', '')->showConfirmButton('Confirm', '#AA0F0A');
        // }

        // // $user = Auth::user();

        // // $admin_info = DB::table('users')->where('id', $user->id)->get();

        // // $list_info = DB::table('users')
        // //     ->whereNot('role', 'resident')
        // //     ->whereNot('id', $user->id)
        // //     ->where('isEnabled', 1)
        // //     ->orderByDesc('id')->get();

        // return redirect()->route('listresident');
    }

    public function deact_listemployee()
    {
        $user = Auth::user();
        if ($user->role != 'Administrator' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $list_info = DB::table('users')
                ->whereNot('role', 'resident')
                ->whereNot('id', $user->id)
                ->where('isEnabled', 0)
                ->orderByDesc('id')->get();
            return view('admin/archiveEmployee', ['list_info' => $list_info, 'admin_info' => $admin_info]);
        }
    }

    public function deact_listresident()
    {
        $user = Auth::user();
        if ($user->role != 'Administrator' && $user->role != 'Barangay Secretary' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $list_info = DB::table('users')
                ->where('role', 'resident')
                ->whereNot('id', $user->id)
                ->where('isEnabled', 0)
                ->orderByDesc('id')->get();
            return view('admin/archiveResident', ['list_info' => $list_info, 'admin_info' => $admin_info]);
        }
    }
    public function updateEmployee(Request $request)
    {
        $emp = User::where('id', $request->id)->first();

        if (User::where('mobile_num', $request->number)->exists() && $emp->mobile_num != $request->number) {
            Alert::error('MOBILE ALREADY EXIST', 'Enter a new mobile number');
        } elseif (User::where('email', $request->email)->exists() && $emp->email != $request->email) {
            Alert::error('EMAIL ALREADY EXIST', 'Enter a new email');
        } else {
            User::where('id', $request->id)->update([
                "first_name" => strtoupper($request->first_name),
                "middle_name" => strtoupper($request->middle_name),
                "last_name" => strtoupper($request->last_name),
                "suffix" =>  strtoupper($request->suffix),
                "gender" => $request->gender,
                "marital_status" =>  $request->marital_status,
                "nationality" =>  $request->nationality,
                "birthdate" =>  $request->birthdate,
                "place_birth" =>  strtoupper($request->place_birth),
                "address_unitNo" =>  strtoupper($request->address_unitNo),
                "address_houseNo" =>  strtoupper($request->address_houseNo),
                "address_street" =>  strtoupper($request->address_street),
                "address_purok" =>  strtoupper($request->address_purok),
                "email" =>  strtolower($request->email),
                "validID_num" => strtoupper($request->validID_num),
                "mobile_num" =>  $request->mobile_num
            ]);
            Alert::success(strtoupper($request->role) . ' ' . ' ACCOUNT SUCCESSFULLY UPDATED', 'You successfully updated this account ')->showConfirmButton('Confirm', '#AA0F0A');;
        }
        $user = Auth::user();
        $admin_info = DB::table('users')->where('id', $user->id)->get();

        $list_info = DB::table('users')
            ->whereNot('role', 'resident')
            ->whereNot('id', $user->id)
            ->where('isEnabled', 1)
            ->orderByDesc('id')->get();

        return redirect()->route('listemployee', ['list_info' => $list_info, 'admin_info' => $admin_info]);
    }
    public function resetPassword(Request $request)
    {
        $data = $request->all();
        $id = $data['user_id'];
        $newPassword = $data['newPassword'];
        $password = User::where('id',  $id)->first()->password;

        $user = Auth::user();
        $admin_info = DB::table('users')->where('id', $user->id)->get();

        $list_info = DB::table('users')
            ->whereNot('role', 'resident')
            ->whereNot('id', $user->id)
            ->where('isEnabled', 1)
            ->orderByDesc('id')->get();

        if (password_verify($newPassword, $password)) {
            Alert::error('NOTHING CHANGE', 'You inputted the same password')->showConfirmButton('Confirm', '#AA0F0A');
        } else {
            Alert::success('You successfully updated the PASSWORD!')->showConfirmButton('Confirm', '#AA0F0A');
            User::where('id', $id)->first()->update(['password' => (Hash::make($newPassword))]);
        }
        return redirect()->route('listemployee', ['list_info' => $list_info, 'admin_info' => $admin_info]);
    }

    public function requestType()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Secretary') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $request_type = Request_type::get();
            return view('admin/requestType', ['admin_info' => $admin_info, 'request_type' => $request_type]);
        }
    }

    public function updateRequestType(Request $request)
    {

        $user = Auth::user();
        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $request_type = Request_type::get();;
        DB::table('request_type')->where('request_type_id', 1)->update(['isEnabled' => $request->bar_id]);
        DB::table('request_type')->where('request_type_id', 2)->update(['isEnabled' => $request->comm_tax]);
        DB::table('request_type')->where('request_type_id', 3)->update(['isEnabled' => $request->bar_clr]);
        DB::table('request_type')->where('request_type_id', 4)->update(['isEnabled' => $request->bar_cert]);
        DB::table('request_type')->where('request_type_id', 5)->update(['isEnabled' => $request->bar_clear]);
        DB::table('request_type')->where('request_type_id', 7)->update(['isEnabled' => $request->concern]);
        Alert::success('You successfully updated the transaction lists online!')->showConfirmButton('Confirm', '#AA0F0A');
        return redirect()->route('requestType', ['admin_info' => $admin_info, 'request_type' => $request_type]);
    }

    public function myAccount()
    {
        $user = Auth::user();
        if ($user->role == 'resident') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            return view('admin/account', ['admin_info' => $admin_info]);
        }
    }
    public function view_request_list()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Secretary' && $user->role != 'Request Manager' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->get();
            // dd($transactions);
            return view("admin/viewRequestList", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }
    public function viewRequest($id)
    {
        $user = Auth::user();
        $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
            ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('reference_key', $id)->get($id);
        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $request_history = Request_History::where('request_id', Requests::where('reference_key', $id)->first()->request_id)->get();
        return view("admin/viewRequest", ['request' => $transactions, 'admin_info' => $admin_info, 'history' => $request_history]);
    }

    public function view_concern_list()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Secretary' && $user->role != 'Concern Manager'  && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->get();
            // dd($transactions);
            return view("admin/viewConcernlist", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }

    public function viewconcern($id)
    {
        $user = Auth::user();
        $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('reference_key', $id)->get($id);
        $admin_info = DB::table('users')->where('id', $user->id)->get();
        $request_history = Concern_History::where('concern', Concerns::where('reference_key', $id)->first()->concern_id)->get();
        return view("admin/viewConcern", ['request' => $transactions, 'admin_info' => $admin_info, 'history' => $request_history]);
    }


    //PAYMENT

    public function listOnlinePayment()
    {

        $user = Auth::user();
        if ($user->role != 'Barangay Treasurer') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {


            $paymentList = Payment::where('payment_status', 'PAID')->get();
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Payment::join('requests', 'requests.request_id', '=', 'payment.request_id')->where('payment_status', 'PAID')->where('isConfirmed', 0)->join('users', 'users.id', '=', 'payment.resident_id')->select('requests.*', 'users.*', 'payment.*', 'payment.created_at as payment_created_at')->get();
            //dd(Payment::join('requests', 'requests.request_id', '=', 'payment.request_id')->join('users', 'users.id', '=', 'payment.resident_id')->select('requests.*', 'users.*','payment.*', 'payment.created_at as payment_created_at')->get());
            return view("admin/listOnlinePayment", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }


    public function confirmOnsitePayment(Request $request)
    {


        $user = Auth::user();

        if ($request->price == 'FREE') {
            $paid = 0;
            $price = 0;
            $change = 0;
        } else {
            $paid = $request->amount_paid;
            $price = $request->price;
            $change = $paid - $price;
        }
        Requests::where('reference_key', $request->reference)->get()->first()->update([
            "request_status" => "CONFIRMED PAYMENT",
            "ctc" => $request->ctc,
            "or_num" => $request->official_receipt,
            "ref" => $request->ref,
        ]);
        $request_info = Requests::where('reference_key', $request->reference)->get()->first();

        Request_History::create([
            'request_id' =>  $request_info->request_id,
            'processed_by' => $user->first_name . " " . $user->last_name,
            'request_status' => 'CONFIRMED',
        ]);
        Payment::create([
            "request_id" => $request_info->request_id,
            "resident_id" => $request_info->resident_id,
            "payment_ref" => $request->ref,
            "payment_method" => "ONSITE PAYMENT",
            "request_price" => $price,
            "payment_status" => "CONFIRMED",
            'amount_paid' => $paid,
            "description_payment" => $request->description_payment,
            'payment_processed_by'    => $user->first_name . ' ' . $user->last_name,
            "isConfirmed" => 1,
        ]);

        //ADD SENDING EMAIL
        Alert::success('PAYMENT CONFIRMED:', $request->reference)->showConfirmButton('Confirm', '#AA0F0A');
        // payor info
        $user_info = User::where('id', $request_info->resident_id)->get()->first();
        $data = [
            'or' => $request->official_receipt,
            'document' => Request_type::where('request_type_id', $request_info->request_type_id)->get()->first()->request_type_name,
            'type' => $request_info->request_description,
            'ref' => $request_info->reference_key,
            'price' => $price,
            'service' => 0,
            'paid' => $paid,
            'change' => $change,
            'name' => $user_info->first_name . ' '.$user_info->middle_name . ' '. $user_info->last_name,
            'mop' => "ONSITE PAYMENT",
            'process' => $user->first_name . ' ' . $user->last_name,
            'date' => Payment::where('request_id' ,$request_info->request_id )->where('payment_status','CONFIRMED')->get()->first()->created_at,

        ];

        Mail::to($user_info->email)->send(new OnsiteReceipt($data));
        return redirect()->route('listReadyForPayment');
    }
    public function confirmPayment(Request $request)
    {

        $user = Auth::user();

        Requests::where('request_id', $request->reference)->get()->first()->update([
            "request_status" => "CONFIRMED PAYMENT",
            "ctc" => $request->ctc,
            "or_num" => $request->official_receipt,
            "ref" => $request->ref,
        ]);

        $request_info = Requests::where('request_id', $request->reference)->get()->first();
        Request_History::create([
            'request_id' =>  $request->reference,
            'processed_by' => $user->first_name . " " . $user->last_name,
            'request_status' => 'CONFIRMED',
        ]);

        $payment_info = Payment::where('request_id', $request->reference)->get()->last();
        Payment::where('request_id', $request->reference)->get()->last()->update([
            "isConfirmed" => 1,
        ]);
        Payment::create([
            "request_id" => $payment_info->request_id,
            "resident_id" => $payment_info->resident_id,
            "payment_ref" => $payment_info->payment_ref,
            "payment_method" => $payment_info->payment_method,
            "request_price" => $payment_info->request_price,
            "service_charge" => $payment_info->service_charge,
            "payment_status" => "CONFIRMED",
            "description_payment" => $request->payment_descrip,
            'payment_processed_by'    => $user->first_name . ' ' . $user->last_name,
            "isConfirmed" => 1,
        ]);

        $user_info = User::where('id', $request_info->resident_id)->get()->first();
        $data = [
            'or' => $request->official_receipt,
            'document' => Request_type::where('request_type_id', $request_info->request_type_id)->get()->first()->request_type_name,
            'type' => $request_info->request_description,
            'ref' => $request_info->reference_key,
            'price' => $request_info->price,
            'paid' => $payment_info->request_price + $payment_info->service_charge,
            'change' => 0,
            'service' => $payment_info->service_charge,
            'name' => $user_info->first_name . ' '.$user_info->middle_name . ' '. $user_info->last_name,
            'mop' => $payment_info->payment_method,
            'process' => $user->first_name . ' ' . $user->last_name,
            'date' => Payment::where('request_id' ,$request_info->request_id )->where('payment_status','CONFIRMED')->get()->first()->created_at,

        ];

        Mail::to($user_info->email)->send(new OnsiteReceipt($data));
                Alert::success(
            'PAYMENT CONFIRMED:',
            Requests::where('request_id', $request->reference)->get()->first()->reference_key
        )
            ->showConfirmButton('Confirm', '#AA0F0A');


        return redirect()->route('listOnlinePayment');
    }

    public function process_payment($ref)
    {

        $user = Auth::user();
        $admin_info = User::where('id', $user->id)->get();

        if ($user->role != 'Barangay Treasurer') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {


            $request_info = Requests::where('request_id', $ref)
                ->join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
                ->select('requests.*', 'request_type.*', 'users.*', 'requests.created_at as created')->get()->first();

            if ($request_info == NULL || $request_info->request_status != "READY FOR PAYMENT") {
                Alert::error('INVALID KEY', '')->showConfirmButton('Confirm', '#AA0F0A');
                return redirect()->route('listReadyForPayment');
            }



            return view("admin/processOnsitePayment", ['admin_info' => $admin_info, 'request' => $request_info]);
        }
    }
    public function listReadyForPayment()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Treasurer') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $paymentList = Requests::where('request_status', 'READY FOR PAYMENT')
                ->join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')
                ->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as requests_date')
                ->get();
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            return view("admin/listReadyForPayment", ['request' => $paymentList, 'admin_info' => $admin_info]);
        }
    }


    public function paymongo_details($id)
    {

        return redirect('https://dashboard.paymongo.com/payments/' . $id);
    }

    public function processRequest()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Secretary' && $user->role != 'Request Manager') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
                ->whereIn('request_status', ['PROCESSING', 'PENDING', 'READY FOR PAYMENT'])->get();

            return view("admin/processRequest", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }

    public function processConcern()
    {
        $user = Auth::user();
        if ($user->role != 'Barangay Secretary' && $user->role != 'Concern Manager') {
            Alert::error('UNAUTHORIZED ACCOUNT', '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('home');
        } else {
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions =  Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')
                ->whereIn('concern_status', ['PROCESSING', 'PENDING'])->get();

            return view("admin/processConcern", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }

    public function process_concern_pending($id)
    {

        $user = Auth::user();
        if (Concerns::where('concern_id', $id)->first()->concern_status == "PENDING" || Concerns::where('concern_id', $id)->first()->concern_processed_by == $user->first_name . " " . $user->last_name) {
            //If the process is Pending then it will change the status to Processing
            if (Concerns::where('concern_id', $id)->first()->concern_status == 'PENDING') {
                #Update the status to processing
                Concerns::where('concern_id', $id)->update([
                    'concern_status' => 'PROCESSING',
                    'concern_processed_by' => $user->first_name . " " . $user->last_name
                ]);
                $process_exist = Concern_History::where('concern', $id)->orderBy('created_at', 'desc')->get()->first();
                if ($process_exist->concern_update_status == 'PENDING') {
                    Concern_History::create([
                        'concern' =>  $id,
                        'employee_name' => $user->first_name . " " . $user->last_name,
                        'concern_update_status' => 'PROCESSING',
                        'concern_update_title' => 'OPENED THE CONCERN',
                        'concern_update_description' => 'The concern was opened by '  .  $user->first_name . " " . $user->last_name
                    ]);
                }
            }
            $transactions = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('concern_id', $id)->get();
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $request_history = Concern_History::where('concern', $id)->get();
            $residents_history = Concerns::join('users', 'users.id', '=', 'concern.resident_id')->select('users.*', 'concern.*', 'concern.created_at as concern_created_at')->where('id', $transactions->first()->id)->get();
            return view("admin/processingConcern", ['request' => $transactions, 'admin_info' => $admin_info, 'history' => $request_history, 'res_history' => $residents_history]);
        } else {
            $processed_by = Concerns::where('concern_id', $id)->first()->concern_processed_by;
            $message = 'THIS REQUEST HAS BEEN PROCESSING BY ' .  $processed_by;
            Alert::error($message, '')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('processConcern');
        }
    }
    public function changeProfilePic(Request $request)
    {

        $id = $request->user_id;
        $user = User::where('id',  $id)->first();
        if ($request->file('profilePic')) {
            $file = $request->file('profilePic');
            $filename = $user->first_name . '_' . $user->last_name . '.' . date("Y-m-d-H-i-s") . $file->getClientOriginalExtension();
            $file->move(public_path('/adminID'), $filename);
        }

        User::where('id',  $id)->first()->update([
            "profilePic" => $filename
        ]);

        toast('You successfully updated your Profile Pic!', 'success');
        return redirect()->route('myAccount');
    }
    public function modifyAdminEmail(Request $request)
    {
        $data = $request->all();
        $id = strtolower($data['user_id']);
        $new_email = strtolower($data["email"]);
        $userInfo =  User::where('id',  $id)->first();
        $exist =  User::where('email',  $new_email)->count();

        if ($exist > 1) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'Email already registred from different account')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('myAccount');
        }
        if ($new_email == $userInfo->email) {
            Alert::error('EMAIL UNSUCCESSFULLY UPDATED', 'You entered your old email')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('myAccount');
        } else {
            User::where('id',  $id)->first()->update(['email' => $new_email]);
            toast('You successfully updated your email!', 'success');
            return redirect()->route('myAccount');
        }
    }

    public function modifyAdminPassword(Request $request)
    {
        $data = $request->all();
        $id = $data['user_id'];
        $newPassword = $data['newPassword'];
        $oldPassword = $data['oldPassword'];
        $password = User::where('id',  $id)->first()->password;

        if (password_verify($newPassword, $password)) {
            Alert::error('NOTHING CHANGE', 'You inputted the same password')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('myAccount');
        } elseif (!password_verify($oldPassword, $password)) {
            Alert::error('CANNOT CHANGE PASSWORD', 'You entered wrong password')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('myAccount');
        } else {
            toast('You successfully updated your PASSWORD!', 'success');
            User::where('id', $id)->first()->update(['password' => (Hash::make($newPassword))]);
            return redirect()->route('myAccount');
        }
    }

    public function modifyAdminMobile(Request $request)
    {
        $data = $request->all();
        $id = strtolower($data['user_id']);
        $new_number = strtolower($data["number"]);
        $userInfo =  User::where('id',  $id)->first();

        if ($new_number == $userInfo->mobile_num) {
            Alert::error('MOBILE NUMBER UNSUCCESSFULLY UPDATED', 'You entered your mobile number')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->route('myAccount');
        } else {
            User::where('id',  $id)->first()->update(['mobile_num' => $new_number]);
            toast('You successfully updated your mobile number!', 'success');
            return redirect()->route('myAccount');
        }
    }


    //when clicking the process
    public function process_pending($id)
    {
        $user = Auth::user();
        if (Requests::where('request_id', $id)->first()->request_status == "PENDING" || Requests::where('request_id', $id)->first()->employee_name == $user->first_name . " " . $user->last_name) {

            //If the process is Pending then it will change the status to Processing
            if (Requests::where('request_id', $id)->first()->request_status == 'PENDING') {
                #Update the status to processing
                Requests::where('request_id', $id)->update([
                    'request_status' => 'PROCESSING',
                    'employee_name' => $user->first_name . " " . $user->last_name
                ]);
                $process_exist = Request_History::where('request_id', $id)->orderBy('created_at', 'desc')->get()->first();
                if ($process_exist->request_status == 'PENDING') {
                    Request_History::create([
                        'request_id' =>  $id,
                        'processed_by' => $user->first_name . " " . $user->last_name,
                        'request_status' => 'PROCESSING',
                    ]);
                }
            }
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('request_id', $id)->get();
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $request_history = Request_History::where('request_id', $id)->get();
            $residents_history = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('id', $transactions->first()->id)->get();
            return view("admin/processingRequest", ['request' => $transactions, 'admin_info' => $admin_info, 'history' => $request_history, 'res_history' => $residents_history]);
        } else {
            $processed_by = Requests::where('request_id', $id)->first()->employee_name;
            $message = 'THIS REQUEST HAS BEEN PROCESSING BY ' .  $processed_by;
            Alert::error($message, '')->showConfirmButton('Confirm', '#AA0F0A');
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
                ->whereIn('request_status', ['PROCESSING', 'PENDING', 'READY FOR PAYMENT'])->get();
            return view("admin/processRequest", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }
    public function reassignrequest($id)
    {
        $user = Auth::user();
        Requests::where('request_id', $id)->update([
            'request_status' => 'PENDING',
            'employee_name' => ""
        ]);
        Request_History::create([
            'request_id' =>  $id,
            'request_status' => 'PENDING',
            'processed_by' => $user->first_name . " " . $user->last_name,
        ]);

        return redirect()->route('processRequest');
    }
    public function reassignconcern($id)
    {
        $user = Auth::user();
        Concerns::where('concern_id', $id)->update([
            'concern_status' => 'PENDING',
            'concern_processed_by' => ""
        ]);
        Concern_History::create([
            'concern' =>  $id,
            'concern_update_status' => 'RE-OPEN',
            'concern_update_title' => 'RE-OPEN THE CONCERN',
            'concern_update_description' => $user->first_name . " " . $user->last_name . ' re-open the concern',
            'employee_name' => $user->first_name . " " . $user->last_name,
        ]);

        return redirect()->route('processConcern');
    }

    public function process_RFP($id)
    {
        $user = Auth::user();
        if (Requests::where('request_id', $id)->first()->request_status == "PENDING" || Requests::where('request_id', $id)->first()->employee_name == $user->first_name . " " . $user->last_name) {

            //If the process is Pending then it will change the status to Processing
            if (Requests::where('request_id', $id)->first()->request_status == 'PENDING') {
                #Update the status to processing
                Requests::where('request_id', $id)->update([
                    'request_status' => 'PROCESSING',
                    'employee_name' => $user->first_name . " " . $user->last_name
                ]);
                $process_exist = Request_History::where('request_id', $id)->orderBy('created_at', 'desc')->get()->first();
                if ($process_exist->request_status == 'PENDING') {
                    Request_History::create([
                        'request_id' =>  $id,
                        'processed_by' => $user->first_name . " " . $user->last_name,
                        'request_status' => 'PROCESSING',
                    ]);
                }
            }
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('request_id', $id)->get();
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $request_history = Request_History::where('request_id', $id)->get();
            $residents_history = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')->where('id', $transactions->first()->id)->get();
            return view("admin/RFPrequest", ['request' => $transactions, 'admin_info' => $admin_info, 'history' => $request_history, 'res_history' => $residents_history]);
        } else {
            $processed_by = Requests::where('request_id', $id)->first()->employee_name;
            $message = 'THIS REQUEST HAS BEEN PROCESSING BY ' .  $processed_by;
            Alert::error($message, '')->showConfirmButton('Confirm', '#AA0F0A');
            $admin_info = DB::table('users')->where('id', $user->id)->get();
            $transactions = Requests::join('users', 'users.id', '=', 'requests.resident_id')
                ->join('request_type', 'request_type.request_type_id', '=', 'requests.request_type_id')->select('users.*', 'requests.*', 'request_type.*', 'requests.created_at as request_date')
                ->whereIn('request_status', ['PROCESSING', 'PENDING', 'READY FOR PAYMENT'])->get();
            return view("admin/processRequest", ['request' => $transactions, 'admin_info' => $admin_info]);
        }
    }

    public function manageWebApp()
    {
        $user = Auth::user();

        $admin_info = DB::table('users')->where('id', $user->id)->get();

        if ($user->role != 'Administrator' && $user->role != 'Barangay Secretary' && $user->role != 'Barangay Captain') {
            Alert::error('UNAUTHORIZED ACCOUNT', 'PLEASE CONTACT THE ADMINISTRATOR')->showConfirmButton('Confirm', '#AA0F0A');
            return redirect()->back();
        } else {
            $web_info = Web_App::get();
            return view('admin/manageWebApp', ['admin_info' => $admin_info, 'web_info' => $web_info]);
        }
    }
}
