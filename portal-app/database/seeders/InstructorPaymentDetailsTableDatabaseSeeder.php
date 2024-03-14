<?php

namespace Database\Seeders;

use App\Models\InstructorPaymentDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorPaymentDetailsTableDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructorpaymentRecords = [
            [
               'id' => 1,
               'instructor_id' => '1',
               'mpesaname' => 'Albert Einstein',
               'mpesamobile' => '0799566434', 
            ]

        ];

        InstructorPaymentDetail::insert($instructorpaymentRecords);
    }
}
