<?php

namespace Database\Seeders;

use App\Models\StudentDetails as ModelsStudentDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class studentDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsStudentDetails::factory(10)->create();
        ModelsStudentDetails::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'student_id' => '213',
            'address' => 'ASDA',
            'profile_picture' => 'ASD',
            'current_school' => 'ASD',
            'previous_school' => 'ASD',
            'parents_details' => 'ASDSA',
            'asigned_teacher' => 'ASD',
            'remember_token' => 'ASDA',

        ]);
    }
}
