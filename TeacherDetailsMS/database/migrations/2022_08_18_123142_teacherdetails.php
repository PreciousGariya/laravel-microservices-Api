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
        Schema::create('teachers_details', function (Blueprint $table) {
            $table->id();
            $table->string('teachers_id')->unique();
            $table->string('address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('current_school')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('experience')->nullable();
            $table->string('expertise')->nullable();
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
        //
    }
};
