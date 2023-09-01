<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_password', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('key');
            $table->string('token');
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
        });

        Schema::table('reset_password', function (Blueprint $table) {
            $table->index('expired_at');
        });

        DB::statement("ALTER TABLE reset_password MODIFY expired_at TIMESTAMP NULL DEFAULT NULL");

        DB::statement("CREATE TRIGGER `set_expired_at` BEFORE INSERT ON `reset_password` FOR EACH ROW
            SET NEW.expired_at = DATE_ADD(NEW.created_at, INTERVAL 30 MINUTE)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reset_password');
    }
};
