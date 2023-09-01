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
        Schema::create('concern_history', function (Blueprint $table) {
            $table->id('concern_history_id');
            $table->foreignId('concern');
            $table->string('concern_status');
            $table->string('concern_update_title');
            $table->string('concern_update_description');
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
        Schema::dropIfExists('concern_history');
    }
};
