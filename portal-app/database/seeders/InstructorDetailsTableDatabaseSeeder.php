<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instructor;

class InstructorDetailsTableDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructorRecords = [
            [
              'id' =>1,
              'name' => 'Albert Einstein',
              'mobile' => '0799566434',
              'email' => 'alberteinstein@gmail.com',
              'course' => 'B.Ed Science(Maths & Chem)',
              'school' => 'Maseno School',
              'experience' => '5 years',
              'image' => ''  
            ]

        ];

        Instructor::insert($instructorRecords);
    }
}
