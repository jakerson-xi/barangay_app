<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "first_name" => "MICHAELS",
                "middle_name" => "DOEM",
                "last_name" => "FANTOS",
                "suffix" =>  "",
                "gender" => "Female",
                "marital_status" => "Single",
                "nationality" =>  "FILIPINO",
                "birthdate" =>  "03/24/1985",
                "place_birth" =>  "QUEZON CITY",
                "address_unitNo" =>  "UNIT 256",
                "address_houseNo" => "324",
                "address_street" =>  "COL. BALLECER EXTN.",
                "address_purok" =>  "Zone 6",
                "email" =>  "michaels@gmail.com",
                "mobile_num" =>  "9254854855",
                "role" =>  "resident",
                "password" => Hash::make("User_123"),
                "valiID_type" => "Philippine passport",
                "validID_num" => "4588484",
                "OTP" => "3433",
                "isEnabled" => 1
            ],
            [
                "first_name" => "MICHAEL",
                "middle_name" => "DOE",
                "last_name" => "SANTOS",
                "suffix" =>  "",
                "gender" => "Male",
                "marital_status" => "Single",
                "nationality" =>  "FILIPINO",
                "birthdate" =>  "01/22/2001",
                "place_birth" =>  "QUEZON CITY",
                "address_unitNo" =>  "UNIT 256",
                "address_houseNo" => "324",
                "address_street" =>  "COL. BALLECER EXTN.",
                "address_purok" =>  "Zone 6",
                "email" =>  "michael@gmail.com",
                "mobile_num" =>  "9254854855",
                "role" =>  "resident",
                "password" => Hash::make("User_123"),
                "valiID_type" => "Philippine passport",
                "validID_num" => "4588484",
                "OTP" => "3433",
                "isEnabled" => 1
            ]
        ]);
    }
}
