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
        Schema::create('concern', function (Blueprint $table) {
            $table->id('concern_id');
            $table->foreignId('resident_id');
            $table->string('concern_title');
            $table->string('concern_description');
            $table->string('concern_type');
            $table->string('concern_status');
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
        Schema::dropIfExists('concern');
    }
};
