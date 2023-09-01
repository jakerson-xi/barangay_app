<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class addUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    // public function run()
    // {
    //     $users = [
    //         [

    //             "first_name" => "ABRAHAM",
    //             "middle_name" => "FERRER",
    //             "last_name" => "HIDAMA",
    //             "suffix" =>  "",
    //             "gender" => "Male",
    //             "marital_status" => "Married",
    //             "nationality" =>  "FILIPINO",
    //             "birthdate" =>  "12/03/1974",
    //             "place_birth" =>  "PARANAQUE CITY",
    //             "address_unitNo" =>  "UNIT 188",
    //             "address_houseNo" => "188",
    //             "address_street" =>  "QUINTAR",
    //             "address_purok" =>  "Zone 1",
    //             "email" =>  "abraham@gmail.com",
    //             "mobile_num" =>  "9213452250",
    //             "role" =>  "resident",
    //             "password" => Hash::make("User_123"),
    //             "valiID_type" => "Philippine passport",
    //             "validID_num" => "4588484",
    //             "OTP" => "3433",
    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "AGRIPINA",
    //             "middle_name" => "LORZANA",
    //             "last_name" => "CRUZ",
    //             "suffix" =>  "",
    //             "gender" => "Female",
    //             "marital_status" => "Single",
    //             "nationality" =>  "FILIPINO",
    //             "birthdate" =>  "01/22/2001",
    //             "place_birth" =>  "QUEZON CITY",
    //             "address_unitNo" =>  "UNIT 256",
    //             "address_houseNo" => "324",
    //             "address_street" =>  "COL. BALLECER EXTN.",
    //             "address_purok" =>  "Zone 1",
    //             "email" =>  "agripina@gmail.com",
    //             "mobile_num" =>  "9254823415",
    //             "role" =>  "resident",
    //             "password" => Hash::make("User_123"),
    //             "valiID_type" => "Philippine passport",
    //             "validID_num" => "4588484",
    //             "OTP" => "3433",
    //             "isEnabled" => 1
    //         ],
    //         [

    //             "first_name" => "John",

    //             "middle_name" => "Doe",

    //             "last_name" => "Smith",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "08/14/1992",

    //             "place_birth" => "Cavite",

    //             "address_unitNo" => "Unit 301",

    //             "address_houseNo" => "301",

    //             "address_street" => "Col. Ballecer",

    //             "address_purok" => "Zone 3",

    //             "email" => "john.smith@gmail.com",

    //             "mobile_num" => "1234567890",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "A1234567",

    //             "OTP" => "1111",

    //             "isEnabled" => 1

    //         ],

    //         [
    //             "first_name" => "Jane",
    //             "middle_name" => "Marie",
    //             "last_name" => "Johnson",
    //             "suffix" => "",
    //             "gender" => "Female",
    //             "marital_status" => "Single",
    //             "nationality" => "FILIPINO",
    //             "birthdate" => "09/22/1999",
    //             "place_birth" => "Manchester",
    //             "address_unitNo" => "Unit 102",
    //             "address_houseNo" => "102",
    //             "address_street" => "Orchid",
    //             "address_purok" => "Zone 2",
    //             "email" => "jane.johnson@gmail.com",
    //             "mobile_num" => "2345678901",
    //             "role" => "resident",
    //             "password" => Hash::make("User_123"),
    //             "valiID_type" => "Passport",
    //             "validID_num" => "B1234567",
    //             "OTP" => "2222",
    //             "isEnabled" => 1
    //         ],

    //         [

    //             "first_name" => "William",

    //             "middle_name" => "Henry",

    //             "last_name" => "Lee",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "11/29/1985",

    //             "place_birth" => "Shanghai",

    //             "address_unitNo" => "Unit 405",

    //             "address_houseNo" => "405",

    //             "address_street" => "Martinez",

    //             "address_purok" => "Zone 1",

    //             "email" => "william.lee@gmail.com",

    //             "mobile_num" => "3456789012",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "National ID",

    //             "validID_num" => "C1234567",

    //             "OTP" => "3333",

    //             "isEnabled" => 1

    //         ],
    //         [
    //             "first_name" => "Maria",

    //             "middle_name" => "Gonzales",

    //             "last_name" => "Alvarez",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" => "Filipino",

    //             "birthdate" => "05/21/2001",

    //             "place_birth" => "Quezon City",

    //             "address_unitNo" => "Unit 301",

    //             "address_houseNo" => "354",

    //             "address_street" => "Col. Ballecer",

    //             "address_purok" => "Zone 3",

    //             "email" => "maria.alvarez@gmail.com",

    //             "mobile_num" => "9187854567",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "1234567890",

    //             "OTP" => "4432",

    //             "isEnabled" => 1


    //         ],
    //         [
    //             "first_name" => "John",

    //             "middle_name" => "Garcia",

    //             "last_name" => "Cruz",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "Filipino",

    //             "birthdate" => "11/07/1989",

    //             "place_birth" => "Pasig City",

    //             "address_unitNo" => "Unit 302",

    //             "address_houseNo" => "776",

    //             "address_street" => "Orchid",

    //             "address_purok" => "Zone 2",

    //             "email" => "john.cruz@gmail.com",

    //             "mobile_num" => "9174326789",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "0987654321",

    //             "OTP" => "1245",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Sarah",

    //             "middle_name" => "Tolentino",

    //             "last_name" => "Dizon",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Separated",

    //             "nationality" => "Filipino",

    //             "birthdate" => "08/15/1996",

    //             "place_birth" => "Makati City",

    //             "address_unitNo" => "Unit 103",

    //             "address_houseNo" => "871",

    //             "address_street" => "Martinez",

    //             "address_purok" => "Zone 4",

    //             "email" => "sarah.dizon@gmail.com",

    //             "mobile_num" => "9267891234",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "PhilHealth ID",

    //             "validID_num" => "5432109876",

    //             "OTP" => "6543",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Michael",

    //             "middle_name" => "Tan",

    //             "last_name" => "Espinosa",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "Filipino",

    //             "birthdate" => "03/29/1991",

    //             "place_birth" => "Pasig City",

    //             "address_unitNo" => "Unit 302",

    //             "address_houseNo" => "776",

    //             "address_street" => "Orchid",

    //             "address_purok" => "Zone 2",

    //             "email" => "john.cruz@gmail.com",

    //             "mobile_num" => "9174326789",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "0987654321",

    //             "OTP" => "1245",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JASMINE",

    //             "middle_name" => "GARCIA",

    //             "last_name" => "MIRANDA",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "06/12/2001",

    //             "place_birth" => "QUEZON CITY",

    //             "address_unitNo" => "UNIT 44",

    //             "address_houseNo" => "44",

    //             "address_street" => "MARTINEZ",

    //             "address_purok" => "Zone 2",

    //             "email" => "jasmiranda@gmail.com",

    //             "mobile_num" => "9213452251",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "N01-01-0000001",

    //             "OTP" => "1289",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "CHRISTIAN",

    //             "middle_name" => "RAMIREZ",

    //             "last_name" => "DE LEON",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "09/23/2003",

    //             "place_birth" => "MANDALUYONG CITY",

    //             "address_unitNo" => "UNIT 13",

    //             "address_houseNo" => "13",

    //             "address_street" => "PRES. GARCIA",

    //             "address_purok" => "Zone 3",

    //             "email" => "chrideleon@gmail.com",

    //             "mobile_num" => "9213452252",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "1234-5678-9012",

    //             "OTP" => "5678",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "ANGELA",

    //             "middle_name" => "REYES",

    //             "last_name" => "CRUZ",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "02/18/1995",

    //             "place_birth" => "SAN JUAN CITY",

    //             "address_unitNo" => "UNIT 53",

    //             "address_houseNo" => "53",

    //             "address_street" => "STO. NIÑO",

    //             "address_purok" => "Zone 4",

    //             "email" => "angelacruz@gmail.com",

    //             "mobile_num" => "9213452253",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "789456123",

    //             "OTP" => "2345",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "BRIAN",

    //             "middle_name" => "TORRES",

    //             "last_name" => "GOMEZ",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "09/23/2003",

    //             "place_birth" => "MANDALUYONG CITY",

    //             "address_unitNo" => "UNIT 13",

    //             "address_houseNo" => "13",

    //             "address_street" => "PRES. GARCIA",

    //             "address_purok" => "Zone 3",

    //             "email" => "chrideleon@gmail.com",

    //             "mobile_num" => "9213452252",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "1234-5678-9012",

    //             "OTP" => "5678",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => ' Mary',
    //             'middle_name' => 'Cruz',
    //             'last_name' => 'Santos',
    //             "suffix" => "",
    //             "gender" => "Female",
    //             "marital_status" => 'Single',
    //             'nationality' => "FILIPINO",
    //             "birthdate" => "08/21/1997",
    //             "place_birth" => "Quezon City",

    //             "address_unitNo" => "Unit 12",

    //             "address_houseNo" => "153",

    //             "address_street" => "Daisy",

    //             "address_purok" => "Zone 3",

    //             "email" => "mary.santos@gmail.com",

    //             "mobile_num" => "9183746521",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "789456123",

    //             "OTP" => "2345",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "John",

    //             "middle_name" => "Cruz",

    //             "last_name" => "Reyes",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "03/08/1985",

    //             "place_birth" => "Mandaluyong City",

    //             "address_unitNo" => "Unit 24",

    //             "address_houseNo" => "321",

    //             "address_street" => "Col. Ballecer",

    //             "address_purok" => "Zone 4",

    //             "email" => "john.reyes@gmail.com",

    //             "mobile_num" => "9165437892",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "1234-5678-9012",

    //             "OTP" => "5678",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Mary",

    //             "middle_name" => "Ann",

    //             "last_name" => "Smith",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "American",

    //             "birthdate" =>  "05/16/1999",

    //             "place_birth" =>  "California",

    //             "address_unitNo" =>  "UNIT 101",

    //             "address_houseNo" => "101",

    //             "address_street" =>  "Martinez",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "mary.smith@gmail.com",

    //             "mobile_num" =>  "1234567890",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's license",

    //             "validID_num" => "A12345678",

    //             "OTP" => "3433",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "John",

    //             "middle_name" => "Patrick",

    //             "last_name" => "Doe",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "Canadian",

    //             "birthdate" =>  "02/25/1988",

    //             "place_birth" =>  "Ontario",

    //             "address_unitNo" =>  "UNIT 205",

    //             "address_houseNo" => "205",

    //             "address_street" =>  "Palma",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "johndoe@gmail.com",

    //             "mobile_num" =>  "2345678901",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "B12345678",

    //             "OTP" => "3433",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Emily",

    //             "middle_name" => "Rose",

    //             "last_name" => "Johnson",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Divorced",

    //             "nationality" =>  "British",

    //             "birthdate" =>  "09/01/1995",

    //             "place_birth" =>  "London",

    //             "address_unitNo" =>  "UNIT 301",

    //             "address_houseNo" => "301",

    //             "address_street" =>  "Pres. Laurel",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "emilyjohnson@gmail.com",

    //             "mobile_num" =>  "3456789012",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "National ID",

    //             "validID_num" => "C12345678",

    //             "OTP" => "3433",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "John",

    //             "middle_name" => "Paul",

    //             "last_name" => "Garcia",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "Filipino",

    //             "birthdate" => "04/02/2004",

    //             "place_birth" => "Manila",

    //             "address_unitNo" => "Unit 10",

    //             "address_houseNo" => "120",

    //             "address_street" => "Gen. del Pilar",

    //             "address_purok" => "Zone 2",

    //             "email" => "john_garcia@yahoo.com",

    //             "mobile_num" => "09123456789",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine Passport",

    //             "validID_num" => "A1234567",

    //             "OTP" => "1234",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Jane",

    //             "middle_name" => "Doe",

    //             "last_name" => "Perez",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" => "Filipino",

    //             "birthdate" => "08/25/1990",

    //             "place_birth" => "Quezon City",

    //             "address_unitNo" => "Unit 5",

    //             "address_houseNo" => "85",

    //             "address_street" => "Aguirre",

    //             "address_purok" => "Zone 1",

    //             "email" => "jane_perez@gmail.com",

    //             "mobile_num" => "09123456780",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine Driver's License",

    //             "validID_num" => "123456789012",

    //             "OTP" => "5678",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "Juan",

    //             "middle_name" => "Cruz",

    //             "last_name" => "Santos",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "Filipino",

    //             "birthdate" => "02/17/2002",

    //             "place_birth" => "Pasig City",

    //             "address_unitNo" => "Unit 3",

    //             "address_houseNo" => "56",

    //             "address_street" => "Pres. Garcia",

    //             "address_purok" => "Zone 2",

    //             "email" => "juan_santos@yahoo.com",

    //             "mobile_num" => "09123456791",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philhealth ID",

    //             "validID_num" => "123456789012",

    //             "OTP" => "9012",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "POLER",

    //             "middle_name" => "MUNISPO",

    //             "last_name" => "ESTAFA",

    //             "suffix" =>  "JR.",

    //             "gender" => "MALE",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "04/25/1995",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 823",

    //             "address_houseNo" => "5",

    //             "address_street" =>  "ORCHID",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "pmestafa@gmail.com",

    //             "mobile_num" =>  "9237346565",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "019542",

    //             "OTP" => "2845",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MICHELLE",

    //             "middle_name" => "DELOS",

    //             "last_name" => "ANGELES",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/13/2000",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 256",

    //             "address_houseNo" => "324",

    //             "address_street" =>  "MANALILI",

    //             "address_purok" =>  "Zone 1",

    //             "email" =>  "mdangeles@gmail.com",

    //             "mobile_num" =>  "9618273233",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "323324",

    //             "OTP" => "2425",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "FRANCIS",

    //             "middle_name" => "CORNEJO",

    //             "last_name" => "POGI",

    //             "suffix" =>  "SR.",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/11/1997",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 552",

    //             "address_houseNo" => "11",

    //             "address_street" =>  "ATIS",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "fcpogi@gmail.com",

    //             "mobile_num" =>  "9610928988",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "751823",

    //             "OTP" => "3433",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "EVA",

    //             "middle_name" => "SANTOS",

    //             "last_name" => "VILLANUEVA",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "12/21/2001",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 11",

    //             "address_houseNo" => "2",

    //             "address_street" =>  "AGUIRRE",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "esvillanueva@gmail.com",

    //             "mobile_num" =>  "9297746565",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "128478",

    //             "OTP" => "8472",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "FILEMON",

    //             "middle_name" => "KULINTA",

    //             "last_name" => "PADRE",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/14/2002",

    //             "place_birth" =>  "MAKATI CITY",

    //             "address_unitNo" =>  "UNIT 23",

    //             "address_houseNo" => "8",

    //             "address_street" =>  "A. Bonifacio",

    //             "address_purok" =>  "Zone 6",

    //             "email" =>  "fkpadre@gmail.com",

    //             "mobile_num" =>  "9619908652",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's license",

    //             "validID_num" => "829213",

    //             "OTP" => "9902",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MIKAELA",

    //             "middle_name" => "ESTRADA",

    //             "last_name" => "CRUZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Separated",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/11/1998",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 61",

    //             "address_houseNo" => "4",

    //             "address_street" =>  "COL. BALLECER EXTN.",

    //             "address_purok" =>  "Zone 6",

    //             "email" =>  "mecruz@gmail.com",

    //             "mobile_num" =>  "9254854855",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "872938",

    //             "OTP" => "3433",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JOSE",

    //             "middle_name" => "FIDEL",

    //             "last_name" => "RAMOS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/11/1991",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 11",

    //             "address_houseNo" => "11",

    //             "address_street" =>  "HERBS",

    //             "address_purok" =>  "Zone 1",

    //             "email" =>  "jframos@gmail.com",

    //             "mobile_num" =>  "9611111111",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "811112",

    //             "OTP" => "1111",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "WILKINS",

    //             "middle_name" => "VILLARET",

    //             "last_name" => "CADUCIO",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "031/11/2002",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 24",

    //             "address_houseNo" => "8",

    //             "address_street" =>  "A. BONIFACIO",

    //             "address_purok" =>  "Zone 6",

    //             "email" =>  "wvcaducio@gmail.com",

    //             "mobile_num" =>  "9618291408",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "031102",

    //             "OTP" => "2312",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "PRETTY",

    //             "middle_name" => "GERRY",

    //             "last_name" => "MARIA",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Divorced",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "01/01/2001",

    //             "place_birth" =>  "",

    //             "address_unitNo" =>  "UNIT 256",

    //             "address_houseNo" => "324",

    //             "address_street" =>  "RANGER",

    //             "address_purok" =>  "Zone 5",

    //             "email" =>  "pgmaria@gmail.com",

    //             "mobile_num" =>  "9986574232",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "062866",

    //             "OTP" => "9572",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "SANTO",

    //             "middle_name" => "PEDRO",

    //             "last_name" => "SANTOS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "01/22/2001",

    //             "place_birth" =>  "MANILA CITY",

    //             "address_unitNo" =>  "UNIT 114",

    //             "address_houseNo" => "56",

    //             "address_street" =>  "ARMY ROAD",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "michael@gmail.com",

    //             "mobile_num" =>  "9617723134",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "892466",

    //             "OTP" => "1004",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JANELLA",

    //             "middle_name" => "ROSE",

    //             "last_name" => "DELA CRUZ",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "06/12/1994",

    //             "place_birth" => "MANILA",

    //             "address_unitNo" => "UNIT 1201",

    //             "address_houseNo" => "282",

    //             "address_street" => "PRES. ROXAS",

    //             "address_purok" => "Zone 2",

    //             "email" => "janelladc@gmail.com",

    //             "mobile_num" => "9265783499",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine driver's license",

    //             "validID_num" => "A4321-12345-78901",

    //             "OTP" => "8877",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JIMMY",

    //             "middle_name" => "RIVERA",

    //             "last_name" => "MARTINEZ",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "11/22/1980",

    //             "place_birth" => "QUEZON CITY",

    //             "address_unitNo" => "UNIT 708",

    //             "address_houseNo" => "312",

    //             "address_street" => "PRES. MAGSAYSAY",

    //             "address_purok" => "Zone 4",

    //             "email" => "jimmymartinez@gmail.com",

    //             "mobile_num" => "9273327456",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine postal ID",

    //             "validID_num" => "123456789012345678",

    //             "OTP" => "5544",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MARY",

    //             "middle_name" => "GRACE",

    //             "last_name" => "TORRES",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Widowed",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "09/18/1976",

    //             "place_birth" => "CALOOCAN CITY",

    //             "address_unitNo" => "UNIT 406",

    //             "address_houseNo" => "250",

    //             "address_street" => "PRES. LAUREL",

    //             "address_purok" => "Zone 1",

    //             "email" => "marygtorres@gmail.com",

    //             "mobile_num" => "9264890123",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine national ID",

    //             "validID_num" => "1234-5678-9012",

    //             "OTP" => "1345",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JONATHAN",

    //             "middle_name" => "CRUZ",

    //             "last_name" => "MENDOZA",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "09/12/1990",

    //             "place_birth" => "MANILA",

    //             "address_unitNo" => "UNIT 102",

    //             "address_houseNo" => "1234",

    //             "address_street" => "DIRECTO",

    //             "address_purok" => "Purok 2",

    //             "email" => "jonathan.mendoza@gmail.com",

    //             "mobile_num" => "9254865656",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "B1234567",

    //             "OTP" => "9888",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JASMINE",

    //             "middle_name" => "TAN",

    //             "last_name" => "CHAN",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "04/20/1995",

    //             "place_birth" => "CEBU CITY",

    //             "address_unitNo" => "UNIT 15",

    //             "address_houseNo" => "2345",

    //             "address_street" => "GUMAMELA",

    //             "address_purok" => "Purok 3",

    //             "email" => "jasmine.chan@gmail.com",

    //             "mobile_num" => "9254876767",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "P1234567",

    //             "OTP" => "4455",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "ERIC",

    //             "middle_name" => "GARCIA",

    //             "last_name" => "SANTOS",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "07/15/1997",

    //             "place_birth" => "MAKATI CITY",

    //             "address_unitNo" => "UNIT 3",

    //             "address_houseNo" => "3456",

    //             "address_street" => "MARTINEZ",

    //             "address_purok" => "Purok 4",

    //             "email" => "eric.santos@gmail.com",

    //             "mobile_num" => "9254887878",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "S1234567",

    //             "OTP" => "5566",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "CHARLES",

    //             "middle_name" => "DALE",

    //             "last_name" => "FERNANDEZ",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "06/17/1988",

    //             "place_birth" =>  "MANDAUE CITY",

    //             "address_unitNo" =>  "UNIT 44",

    //             "address_houseNo" => "128",

    //             "address_street" =>  "CONVERGENCE",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "charles.fernandez@gmail.com",

    //             "mobile_num" =>  "9285748585",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "G13331-1",

    //             "OTP" => "2121",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "BEA",

    //             "middle_name" => "RODRIGUEZ",

    //             "last_name" => "CORDERO",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "12/03/1997",

    //             "place_birth" =>  "MANILA CITY",

    //             "address_unitNo" =>  "UNIT 1201",

    //             "address_houseNo" => "742",

    //             "address_street" =>  "BAYANIHAN ROAD",

    //             "address_purok" =>  "Zone 7",

    //             "email" =>  "bea.cordero@gmail.com",

    //             "mobile_num" =>  "9213876589",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID Card",

    //             "validID_num" => "S1118567-1",

    //             "OTP" => "8889",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "DAVID",

    //             "middle_name" => "CARLO",

    //             "last_name" => "MORALES",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/21/1981",

    //             "place_birth" =>  "CEBU CITY",

    //             "address_unitNo" =>  "UNIT 22",

    //             "address_houseNo" => "348",

    //             "address_street" =>  "ILA-ILA",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "david.morales@gmail.com",

    //             "mobile_num" =>  "9398888545",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "J2458533",

    //             "OTP" => "1198",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JOHN",

    //             "middle_name" => "CARLO",

    //             "last_name" => "SANTOS",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "07/11/1992",

    //             "place_birth" => "PARANAQUE CITY",

    //             "address_unitNo" => "UNIT 3C",

    //             "address_houseNo" => "38",

    //             "address_street" => "MARTINEZ",

    //             "address_purok" => "Zone 4",

    //             "email" => "johnsantos@gmail.com",

    //             "mobile_num" => "9177560235",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's license",

    //             "validID_num" => "A1234567890",

    //             "OTP" => "8882",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MARIE",

    //             "middle_name" => "DOMINGO",

    //             "last_name" => "RAMIREZ",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "09/22/1999",

    //             "place_birth" => "MUNTINLUPA CITY",

    //             "address_unitNo" => "UNIT 12A",

    //             "address_houseNo" => "27",

    //             "address_street" => "PRES. QUIRINO",

    //             "address_purok" => "Zone 7",

    //             "email" => "marieramirez@yahoo.com",

    //             "mobile_num" => "9237890256",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "09-1234567-8",

    //             "OTP" => "1735",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "PAUL",

    //             "middle_name" => "BAUTISTA",

    //             "last_name" => "CRUZ",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Separated",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "11/19/1988",

    //             "place_birth" => "PASAY CITY",

    //             "address_unitNo" => "UNIT 4D",

    //             "address_houseNo" => "12",

    //             "address_street" => "J.P. LAUREL",

    //             "address_purok" => "Zone 5",

    //             "email" => "paulcruz@hotmail.com",

    //             "mobile_num" => "9194560789",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "EB1234567",

    //             "OTP" => "6409",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JASMINE",

    //             "middle_name" => "RAMIREZ",

    //             "last_name" => "FERNANDEZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/11/1992",

    //             "place_birth" =>  "MARIKINA CITY",

    //             "address_unitNo" =>  "UNIT 102",

    //             "address_houseNo" => "21",

    //             "address_street" =>  "PRES. LAUREL",

    //             "address_purok" =>  "Zone 5",

    //             "email" =>  "jasminefernandez@gmail.com",

    //             "mobile_num" =>  "9776341928",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "M7891202541",

    //             "OTP" => "1726",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "BRANDON",

    //             "middle_name" => "GOMEZ",

    //             "last_name" => "SANTOS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "01/02/1998",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 607",

    //             "address_houseNo" => "58",

    //             "address_street" =>  "PRES. GARCIA",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "brandonsantos@gmail.com",

    //             "mobile_num" =>  "9264752837",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "E446920",

    //             "OTP" => "8191",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "SABRINA",

    //             "middle_name" => "BAUTISTA",

    //             "last_name" => "CRUZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "10/21/1987",

    //             "place_birth" =>  "PASIG CITY",

    //             "address_unitNo" =>  "UNIT 710",

    //             "address_houseNo" => "29",

    //             "address_street" =>  "MANGGAHAN",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "sabrinacruz@gmail.com",

    //             "mobile_num" =>  "9772940383",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "0223456789",

    //             "OTP" => "9538",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "DARLENE",

    //             "middle_name" => "KIM",

    //             "last_name" => "BARRETO",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/07/1992",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 14",

    //             "address_houseNo" => "738",

    //             "address_street" =>  "JASMIN",

    //             "address_purok" =>  "Purok 2",

    //             "email" =>  "darlenebarreto@gmail.com",

    //             "mobile_num" =>  "9478325123",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's license",

    //             "validID_num" => "T-458621",

    //             "OTP" => "2468",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "ELLIOT",

    //             "middle_name" => "JOHN",

    //             "last_name" => "MENDOZA",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Separated",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/18/1978",

    //             "place_birth" =>  "PASIG CITY",

    //             "address_unitNo" =>  "UNIT 32",

    //             "address_houseNo" => "1221",

    //             "address_street" =>  "PRES. LAUREL",

    //             "address_purok" =>  "Purok 7",

    //             "email" =>  "elliotmendoza@gmail.com",

    //             "mobile_num" =>  "9251671234",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID card",

    //             "validID_num" => "5432156789",

    //             "OTP" => "1357",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "JONATHAN",

    //             "middle_name" => "LEE",

    //             "last_name" => "REYES",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/23/1989",

    //             "place_birth" =>  "MANILA CITY",

    //             "address_unitNo" =>  "UNIT 23",

    //             "address_houseNo" => "841",

    //             "address_street" =>  "GEN. DEL PILAR",

    //             "address_purok" =>  "Purok 9",

    //             "email" =>  "jonathanreyes@gmail.com",

    //             "mobile_num" =>  "9178349012",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "PO19900304",

    //             "OTP" => "7890",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "CRISTIAN",

    //             "middle_name" => "FERMIN",

    //             "last_name" => "BALDEO",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "06/17/1990",

    //             "place_birth" => "PASAY CITY",

    //             "address_unitNo" => "UNIT 18",

    //             "address_houseNo" => "121",

    //             "address_street" => "PRES. LAUREL",

    //             "address_purok" => "Zone 3",

    //             "email" => "cristian.baldeo@gmail.com",

    //             "mobile_num" => "9234848585",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "1234567890",

    //             "OTP" => "4556",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "KATRINA",

    //             "middle_name" => "BERNAL",

    //             "last_name" => "MANANGAN",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "08/23/1986",

    //             "place_birth" => "MANILA CITY",

    //             "address_unitNo" => "UNIT 12",

    //             "address_houseNo" => "76",

    //             "address_street" => "PRES. GARCIA",

    //             "address_purok" => "Zone 2",

    //             "email" => "katrina.manangan@yahoo.com",

    //             "mobile_num" => "9255567843",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "0987654321",

    //             "OTP" => "1234",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "ANA",

    //             "middle_name" => "BAUTISTA",

    //             "last_name" => "GONZALES",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "07/14/1997",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 212",

    //             "address_houseNo" => "480",

    //             "address_street" =>  "HERBS DIRECTO",

    //             "address_purok" =>  "Phase 1",

    //             "email" =>  "anabgonzales@gmail.com",

    //             "mobile_num" =>  "9152424752",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "Z1256-02147-85451",

    //             "OTP" => "7883",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "KATHRINE",

    //             "middle_name" => "REYES",

    //             "last_name" => "JAVIER",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/12/1991",

    //             "place_birth" =>  "MANILA",

    //             "address_unitNo" =>  "UNIT 111",

    //             "address_houseNo" => "456",

    //             "address_street" =>  "BANABA",

    //             "address_purok" =>  "Phase 2",

    //             "email" =>  "kathrinejavier@gmail.com",

    //             "mobile_num" =>  "9174216578",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "8531856",

    //             "OTP" => "4956",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "JAMES",

    //             "middle_name" => "GONZALES",

    //             "last_name" => "MENDOZA",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/01/1980",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "",

    //             "address_houseNo" => "123",

    //             "address_street" =>  "VISAYAS",

    //             "address_purok" =>  "Phase 1",

    //             "email" =>  "jamesgmendoza@gmail.com",

    //             "mobile_num" =>  "9254789632",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Voter's ID",

    //             "validID_num" => "1278-9812-5415",

    //             "OTP" => "6348",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MAURICE",

    //             "middle_name" => "SALAZAR",

    //             "last_name" => "CASTRO",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "12/10/1998",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 562",

    //             "address_houseNo" => "23",

    //             "address_street" =>  "BANABA",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "maurice.castro@gmail.com",

    //             "mobile_num" =>  "9254854875",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "4584984",

    //             "OTP" => "4748",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MARIANA",

    //             "middle_name" => "VASQUEZ",

    //             "last_name" => "CRUZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/21/1987",

    //             "place_birth" =>  "TAGUIG CITY",

    //             "address_unitNo" =>  "UNIT 121",

    //             "address_houseNo" => "283",

    //             "address_street" =>  "PRES. MAGSAYSAY",

    //             "address_purok" =>  "Zone 5",

    //             "email" =>  "mariana.cruz@yahoo.com",

    //             "mobile_num" =>  "9254875843",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "4568484",

    //             "OTP" => "3739",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "GABRIEL",

    //             "middle_name" => "MARTINEZ",

    //             "last_name" => "DAVIS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "06/14/2000",

    //             "place_birth" =>  "PASIG CITY",

    //             "address_unitNo" =>  "UNIT 456",

    //             "address_houseNo" => "394",

    //             "address_street" =>  "BAYANIHAN ROAD",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "gabriel.davis@gmail.com",

    //             "mobile_num" =>  "9254848382",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "1248484",

    //             "OTP" => "7578",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "KYLE",

    //             "middle_name" => "ALVAREZ",

    //             "last_name" => "GOMEZ",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "09/11/1992",

    //             "place_birth" =>  "PASIG CITY",

    //             "address_unitNo" =>  "UNIT 203",

    //             "address_houseNo" => "480",

    //             "address_street" =>  "PRES. GARCIA",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "kylegomez@gmail.com",

    //             "mobile_num" =>  "9455687856",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "A123456789",

    //             "OTP" => "2121",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "KAYLA",

    //             "middle_name" => "MARTINEZ",

    //             "last_name" => "CRUZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/05/1999",

    //             "place_birth" =>  "MANILA CITY",

    //             "address_unitNo" =>  "UNIT 301",

    //             "address_houseNo" => "2101",

    //             "address_street" =>  "VISAYAS",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "kaylacruz@gmail.com",

    //             "mobile_num" =>  "9544857954",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "B45858844",

    //             "OTP" => "7684",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MIGUEL",

    //             "middle_name" => "DIAZ",

    //             "last_name" => "GONZALES",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "06/17/1990",

    //             "place_birth" =>  "MAKATI CITY",

    //             "address_unitNo" =>  "UNIT 502",

    //             "address_houseNo" => "110",

    //             "address_street" =>  "BANABA",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "migueldiaz@gmail.com",

    //             "mobile_num" =>  "9675686587",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "33-1234567-8",

    //             "OTP" => "1122",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MARYJANE",

    //             "middle_name" => "FRANCISCO",

    //             "last_name" => "BACULIO",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "07/11/1988",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 39",

    //             "address_houseNo" => "11",

    //             "address_street" =>  "PRES. GARCIA",

    //             "address_purok" =>  "Zone 8",

    //             "email" =>  "maryjane@gmail.com",

    //             "mobile_num" =>  "9294878754",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "93947283",

    //             "OTP" => "2837",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MARCUS",

    //             "middle_name" => "CHUA",

    //             "last_name" => "TAN",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "10/08/1993",

    //             "place_birth" =>  "MANDALUYONG CITY",

    //             "address_unitNo" =>  "UNIT 25",

    //             "address_houseNo" => "84",

    //             "address_street" =>  "ESPEDILLA",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "marcus.tan@gmail.com",

    //             "mobile_num" =>  "9264839385",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine driver's license",

    //             "validID_num" => "A12345678",

    //             "OTP" => "0987",

    //             "isEnabled" => 1
    //         ],





    //         [
    //             "first_name" => "ANNA",

    //             "middle_name" => "FERNANDEZ",

    //             "last_name" => "GONZALES",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Divorced",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/20/1979",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 33",

    //             "address_houseNo" => "27",

    //             "address_street" =>  "GEN. DEL PILAR",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "anna.gonzales@yahoo.com",

    //             "mobile_num" =>  "9358495757",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "P23098765",

    //             "OTP" => "1836",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "JENNY",

    //             "middle_name" => "BRIONES",

    //             "last_name" => "REYES",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "12/15/1997",

    //             "place_birth" => "QUEZON CITY",

    //             "address_unitNo" => "UNIT 120",

    //             "address_houseNo" => "221",

    //             "address_street" => "PRES. LAUREL",

    //             "address_purok" => "Zone 4",

    //             "email" => "jenny.reyes@gmail.com",

    //             "mobile_num" => "9331564556",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine driver's license",

    //             "validID_num" => "M11223456",

    //             "OTP" => "8987",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "MARK",

    //             "middle_name" => "HERNANDEZ",

    //             "last_name" => "GARCIA",

    //             "suffix" => "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "06/02/1988",

    //             "place_birth" => "MAKATI CITY",

    //             "address_unitNo" => "UNIT 84",

    //             "address_houseNo" => "449",

    //             "address_street" => "PRES. QUIRINO EXTN.",

    //             "address_purok" => "Zone 3",

    //             "email" => "mark.garcia@gmail.com",

    //             "mobile_num" => "9987456231",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "78245631",

    //             "OTP" => "7569",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "BENJAMIN",

    //             "middle_name" => "VILLAR",

    //             "last_name" => "CRUZ",

    //             "suffix" => "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" => "FILIPINO",

    //             "birthdate" => "02/27/1992",

    //             "place_birth" => "MANILA CITY",

    //             "address_unitNo" => "UNIT 45",

    //             "address_houseNo" => "322",

    //             "address_street" => "ESPEDILLA",

    //             "address_purok" => "Zone 2",

    //             "email" => "benjamin.cruz@gmail.com",

    //             "mobile_num" => "9178654321",

    //             "role" => "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "0507890345",

    //             "OTP" => "4563",

    //             "isEnabled" => 1
    //         ],

    //         [

    //             "first_name" => "JONAS",

    //             "middle_name" => "RODRIGO",

    //             "last_name" => "TAN",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/08/1982",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 102",

    //             "address_houseNo" => "235",

    //             "address_street" =>  "PRES. QUIRINO",

    //             "address_purok" =>  "Zone 8",

    //             "email" =>  "jonas.tan@gmail.com",

    //             "mobile_num" =>  "9254847878",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "9876543",

    //             "OTP" => "5637",

    //             "isEnabled" => 1
    //         ],



    //         [
    //             "first_name" => "JADE",

    //             "middle_name" => "GARCIA",

    //             "last_name" => "CASTILLO",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/14/1990",

    //             "place_birth" =>  "MANILA",

    //             "address_unitNo" =>  "UNIT 9",

    //             "address_houseNo" => "412",

    //             "address_street" =>  "VISAYAS",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "jade.castillo@gmail.com",

    //             "mobile_num" =>  "9254847474",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine driver's license",

    //             "validID_num" => "12345678",

    //             "OTP" => "2489",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "NICOLE",

    //             "middle_name" => "ABEJERO",

    //             "last_name" => "MARTINEZ",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/19/1999",

    //             "place_birth" =>  "MARIKINA",

    //             "address_unitNo" =>  "UNIT 406",

    //             "address_houseNo" => "786",

    //             "address_street" =>  "PRES. GARCIA",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "nicole.martinez@gmail.com",

    //             "mobile_num" =>  "9254847109",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Philippine passport",

    //             "validID_num" => "8765432",

    //             "OTP" => "6935",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "KIMBERLY",

    //             "middle_name" => "JOY",

    //             "last_name" => "REYES",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "07/12/1997",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 17",

    //             "address_houseNo" => "321",

    //             "address_street" =>  "PNP ROAD",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "kimberlyr@yahoo.com",

    //             "mobile_num" =>  "9158547578",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "2019097845",

    //             "OTP" => "7859",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "CARLOS",

    //             "middle_name" => "MARTIN",

    //             "last_name" => "BUSTOS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "10/15/1982",

    //             "place_birth" =>  "CALOOCAN CITY",

    //             "address_unitNo" =>  "UNIT 1203",

    //             "address_houseNo" => "77",

    //             "address_street" =>  "CONVERGENCE",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "carlosbustos@gmail.com",

    //             "mobile_num" =>  "9178542658",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "A4848385",

    //             "OTP" => "1876",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MARIA",

    //             "middle_name" => "CRISTINA",

    //             "last_name" => "BAUTISTA",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/18/1991",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 32",

    //             "address_houseNo" => "110",

    //             "address_street" =>  "GEN. LUNA",

    //             "address_purok" =>  "Zone 5",

    //             "email" =>  "mariacristinab@yahoo.com",

    //             "mobile_num" =>  "9258546482",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "03894853",

    //             "OTP" => "2459",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "CHRISTIAN",

    //             "middle_name" => "TANGARO",

    //             "last_name" => "TORRE",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "07/17/1990",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 1502",

    //             "address_houseNo" => "189",

    //             "address_street" =>  "COL. GERVAICO",

    //             "address_purok" =>  "Zone 4",

    //             "email" =>  "christian.torre@gmail.com",

    //             "mobile_num" =>  "9125485548",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "8787444",

    //             "OTP" => "4234",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MARJORIE",

    //             "middle_name" => "BRIONES",

    //             "last_name" => "MENDOZA",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/11/1998",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 805",

    //             "address_houseNo" => "23",

    //             "address_street" =>  "VISAYAS",

    //             "address_purok" =>  "Zone 3",

    //             "email" =>  "marjorie.mendoza@gmail.com",

    //             "mobile_num" =>  "9125484577",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Postal ID",

    //             "validID_num" => "8894544",

    //             "OTP" => "5542",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "RICHARD",

    //             "middle_name" => "CABALLERO",

    //             "last_name" => "SANTOS",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "01/30/1987",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 1406",

    //             "address_houseNo" => "54",

    //             "address_street" =>  "PRES. LAUREL",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "richard.santos@gmail.com",

    //             "mobile_num" =>  "9254854555",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "SSS ID",

    //             "validID_num" => "4656884",

    //             "OTP" => "2876",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JOHN",

    //             "middle_name" => "CRAIG",

    //             "last_name" => "TORRES",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/15/1981",

    //             "place_birth" =>  "PASAY CITY",

    //             "address_unitNo" =>  "UNIT 12C",

    //             "address_houseNo" => "987",

    //             "address_street" =>  "MANGGAHAN",

    //             "address_purok" =>  "Purok 3",

    //             "email" =>  "johntorres@gmail.com",

    //             "mobile_num" =>  "9175546655",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "A1234567890123",

    //             "OTP" => "9943",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JENNA",

    //             "middle_name" => "GRACE",

    //             "last_name" => "PARK",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "KOREAN",

    //             "birthdate" =>  "08/06/1995",

    //             "place_birth" =>  "SEOUL",

    //             "address_unitNo" =>  "UNIT 5F",

    //             "address_houseNo" => "221",

    //             "address_street" =>  "VISAYAS",

    //             "address_purok" =>  "Purok 4",

    //             "email" =>  "jennapark@gmail.com",

    //             "mobile_num" =>  "9254789966",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "B1234567890123",

    //             "OTP" => "1852",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "MARK",

    //             "middle_name" => "JASON",

    //             "last_name" => "RAMIREZ",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/19/1992",

    //             "place_birth" =>  "QUEZON CITY",

    //             "address_unitNo" =>  "UNIT 8D",

    //             "address_houseNo" => "120",

    //             "address_street" =>  "BAYANIHAN ROAD",

    //             "address_purok" =>  "Purok 2",

    //             "email" =>  "markramirez@gmail.com",

    //             "mobile_num" =>  "9397874475",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "123456789012",

    //             "OTP" => "2638",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "JACINTA",

    //             "middle_name" => "P",

    //             "last_name" => "MENDOZA",

    //             "suffix" =>  "",

    //             "gender" => "Female",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "05/16/1990",

    //             "place_birth" =>  "PASIG CITY",

    //             "address_unitNo" =>  "UNIT 456",

    //             "address_houseNo" => "678",

    //             "address_street" =>  "PRES. MAGSAYSAY",

    //             "address_purok" =>  "Zone 2",

    //             "email" =>  "jacinta.mendoza@gmail.com",

    //             "mobile_num" =>  "9987463621",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Driver's License",

    //             "validID_num" => "N409-0134-2596",

    //             "OTP" => "5821",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "NICO",

    //             "middle_name" => "L",

    //             "last_name" => "PASCUAL",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Married",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "11/28/1983",

    //             "place_birth" =>  "MANILA",

    //             "address_unitNo" =>  "",

    //             "address_houseNo" => "1234",

    //             "address_street" =>  "J.P. LAUREL",

    //             "address_purok" =>  "",

    //             "email" =>  "nico.pascual@gmail.com",

    //             "mobile_num" =>  "9876543210",

    //             "role" =>  "admin",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "UMID",

    //             "validID_num" => "1234-5678-9012",

    //             "OTP" => "2167",

    //             "isEnabled" => 1
    //         ],
    //         [
    //             "first_name" => "LUCAS",

    //             "middle_name" => "B",

    //             "last_name" => "TAN",

    //             "suffix" =>  "",

    //             "gender" => "Male",

    //             "marital_status" => "Single",

    //             "nationality" =>  "FILIPINO",

    //             "birthdate" =>  "02/10/1995",

    //             "place_birth" =>  "MAKATI CITY",

    //             "address_unitNo" =>  "",

    //             "address_houseNo" => "789",

    //             "address_street" =>  "MANGGAHAN EXTN.",

    //             "address_purok" =>  "",

    //             "email" =>  "lucas.tan@yahoo.com",

    //             "mobile_num" =>  "9456341789",

    //             "role" =>  "resident",

    //             "password" => Hash::make("User_123"),

    //             "valiID_type" => "Passport",

    //             "validID_num" => "AB1234567",

    //             "OTP" => "3254",

    //             "isEnabled" => 1
    //         ]
    //     ];
    //     foreach ($users as $user) {
    //         User::create($user);
    //     }
    // }
}
