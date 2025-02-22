<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        User::create( [
            'secure_id'         => 'jsbd232snjcs8kd23l5zxq2u4tj',
            'first_name'        => 'Admin',
            'last_name'         => 'User',
            'email'             => 'admin@gmail.com',
            'mobile'             => '9720866645',
            'gender'            => 'Male',
            'company_group_id'  => 1,
            'profile_photo'     => 'profile_photos/admin.jpg',
            'date_of_joining'   => '2023-08-01',
            'salary'            => 50000.00, 
            'email_verified_at' => now(),
        ] );

        User::create( [
            'secure_id'         => 'g9hj3wz2bk5u8d1p7tq0lmnv4s6x',
            'first_name'        => 'Kapil', 
            'last_name'         => 'Narang', 
            'email'             => 'kapil@example.com',
            'mobile'             => '9646096546',
            'gender'            => 'Male', 
            'company_group_id'  => 2, 
            'profile_photo'     => 'profile_photos/kapil.jpg',
            'date_of_joining'   => '2023-09-01', 
            'salary'            => 150000.00,
            'email_verified_at' => now(),
        ] );
    }
}
