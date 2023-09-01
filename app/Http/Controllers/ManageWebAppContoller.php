<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Web_App;

class ManageWebAppContoller extends Controller
{
    public function updateOfficial(Request $request)
    {

        if ($request->file('off_1_pic')) {
            $file = $request->file('off_1_pic');
            $filename_1 = $request->off_1_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_1);
        } else {
            $filename_1 = Web_App::where('id', 1)->get()->first()->file;
        }
        if ($request->file('off_2_pic')) {
            $file = $request->file('off_2_pic');
            $filename_2 = $request->off_2_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_2);
        } else {
            $filename_2 = Web_App::where('id', 2)->get()->first()->file;
        }
        if ($request->file('off_3_pic')) {
            $file = $request->file('off_3_pic');
            $filename_3 = $request->off_3_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_3);
        } else {
            $filename_3 = Web_App::where('id', 3)->get()->first()->file;
        }
        if ($request->file('off_4_pic')) {
            $file = $request->file('off_4_pic');
            $filename_4 = $request->off_4_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_4);
        } else {
            $filename_4 = Web_App::where('id', 4)->get()->first()->file;
        }
        if ($request->file('off_5_pic')) {
            $file = $request->file('off_5_pic');
            $filename_5 = $request->off_5_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_5);
        } else {
            $filename_5 = Web_App::where('id', 5)->get()->first()->file;
        }
        if ($request->file('off_6_pic')) {
            $file = $request->file('off_6_pic');
            $filename_6 = $request->off_6_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_6);
        } else {
            $filename_6 = Web_App::where('id', 6)->get()->first()->file;
        }
        if ($request->file('off_7_pic')) {
            $file = $request->file('off_7_pic');
            $filename_7 = $request->off_7_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_7);
        } else {
            $filename_7 = Web_App::where('id', 7)->get()->first()->file;
        }
        if ($request->file('off_8_pic')) {
            $file = $request->file('off_8_pic');
            $filename_8 = $request->off_8_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_8);
        } else {
            $filename_8 = Web_App::where('id', 8)->get()->first()->file;
        }
        if ($request->file('off_9_pic')) {
            $file = $request->file('off_9_pic');
            $filename_9 = $request->off_9_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_9);
        } else {
            $filename_9 = Web_App::where('id', 9)->get()->first()->file;
        }
        if ($request->file('off_10_pic')) {
            $file = $request->file('off_10_pic');
            $filename_10 = $request->off_10_name . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/adminOfficial'), $filename_10);
        } else {
            $filename_10 = Web_App::where('id', 10)->get()->first()->file;
        }


        for ($i = 1; $i <= 10; $i++) {
            $attribute_name = 'off_' . $i . '_name';
            $filename = 'filename_' . $i;
            Web_App::where('id', $i)->update([
                'content' => $request->$attribute_name,
                'file' => $$filename
            ]);
        }


        toast('Updated version has been submitted!', 'success');
        return redirect()->route('manageWebApp');
    }

    public function updateDemography(Request $request)
    {
        for ($i = 11; $i <= 17; $i++) {
            Web_App::where('id', $i)->update([
                'content' => $request->{'dem_' . $i},
            ]);
        }


        toast('Updated version has been submitted!', 'success');
        return redirect()->route('manageWebApp');
    }

    public function updateContact(Request $request)
    {

        for ($i = 18; $i <= 25; $i++) {
            Web_App::where('id', $i)->update([
                'content' => $request->{'con_' . $i},
            ]);
        }

        toast('Updated version has been submitted!', 'success');
        return redirect()->route('manageWebApp');
    }


    public function updateBanner(Request $request)
    {

        if ($request->file('imageInput28')) {
            $file = $request->file('imageInput28');
            $filename_1 = "banner/banner_1" . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/banner'), $filename_1);
        } else {
            $filename_1 = Web_App::where('id', 28)->get()->first()->content;
        }
        if ($request->file('imageInput29')) {
            $file = $request->file('imageInput29');
            $filename_2 = "banner/banner_2" . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/banner'), $filename_2);
        } else {
            $filename_2 = Web_App::where('id', 29)->get()->first()->content;
        }
        if ($request->file('imageInput30')) {
            $file = $request->file('imageInput30');
            $filename_3 = "banner/banner_3" . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/banner'), $filename_3);
        } else {
            $filename_3 = Web_App::where('id', 30)->get()->first()->content;
        }
        if ($request->file('imageInput31')) {
            $file = $request->file('imageInput31');
            $filename_4 = "banner/banner_4" . date("Y-m-d-H-i-s") . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/banner'), $filename_4);
        } else {
            $filename_4 = Web_App::where('id', 31)->get()->first()->content;
        }

        Web_App::where('id', 28)->update([
            'content' => $filename_1,
        ]);
        Web_App::where('id', 29)->update([
            'content' => $filename_2,
        ]);
        Web_App::where('id', 30)->update([
            'content' => $filename_3,
        ]);
        Web_App::where('id', 31)->update([
            'content' => $filename_4,
        ]);
        toast('Updated banner has been posted!', 'success');
        return redirect()->route('manageWebApp');
    }
}
