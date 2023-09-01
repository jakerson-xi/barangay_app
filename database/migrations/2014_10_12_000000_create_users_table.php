<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('nationality');
            $table->string('birthdate');
            $table->string('place_birth');
            $table->string('address_unitNo');
            $table->string('address_houseNo');
            $table->string('address_street');
            $table->string('address_purok');
            $table->string('email');
            $table->string('password');
            $table->string('mobile_num');
            $table->string('valiID_type');
            $table->string('validID_num');
            $table->string('validID_front');
            $table->string('validID_back');
            $table->string('role');
            $table->string('OTP');
            $table->integer('isVerified')->default(0);
            $table->integer('isEnabled')->default(1);
            $table->rememberToken();
            $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
