<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');

        $adminRecords = [ 
            [
                'id' => 1,
                'name' => 'Admin',
                'type' => 'admin',
                'staff_id' => 0,
                'mobile' => '0723495262',
                'email' => 'admin@admin.com',
                'password' => $password,
                'image' => '',
                'status' => 1   
               ],
            // [
            //  'id' => 2,
            //  'name' => 'John Doe',
            //  'type' => 'subadmin',
            //  'staff_id' => 0,
            //  'mobile' => '0757278442',
            //  'email' => 'john@doe.com',
            //  'password' => $password,
            //  'image' => '',
            //  'status' => 1   
            // ],
            // [
            //     'id' => 3,
            //     'name' => 'Jane Doe',
            //     'type' => 'subadmin',
            //     'staff_id' => 0,
            //     'mobile' => '0797110193',
            //     'email' => 'jane@doe.com',
            //     'password' => $password,
            //     'image' => '',
            //     'status' => 1 
            //    ],
            // [
            //     'id' => 4,
            //     'name' => 'Albert Einstein',
            //     'type' => 'instructor',
            //     'staff_id' => 0,
            //     'mobile' => '0799566434',
            //     'email' => 'alberteinstein@gmail.com',
            //     'password' => $password,
            //     'image' => '',
            //     'status' => 0

            // ]

        ];

        Admin::insert($adminRecords);
    }
}
