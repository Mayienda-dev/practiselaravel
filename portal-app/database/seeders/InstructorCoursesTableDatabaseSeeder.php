<?php

namespace Database\Seeders;

use App\Models\InstructorCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorCoursesTableDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructorcoursesRecords = [
            [
               'id' => 1,
               'instructor_id' => '1',
               'subjects' => 'Mathematics, Physics',
               'paper_speciality' => 'Mathematics paper 1',


            ],

        ];

        InstructorCourse::insert($instructorcoursesRecords);
    }
}
