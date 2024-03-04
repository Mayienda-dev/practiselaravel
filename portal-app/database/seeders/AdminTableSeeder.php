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
            'id'=> 1, 
            'name'=>'Admin',
            'type'=>'Super Admin',
            'staff_id'=>0,
            'mobile' => '0741984912',
            'email' => 'admin@admin.com',
            'password' => $password,
            'image'=> "",
            'status'=>1

        ];

        Admin::insert($adminRecords);
    }
}