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
        Schema::create('students_details', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('current_school')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('parents_details')->nullable();
            $table->string('asigned_teacher')->nullable();
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
        Schema::dropIfExists('student_details');
    }
};
