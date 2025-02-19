<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'secure_id'         => 'jsbd232snjcs8kd23l5zxq2u4tj',
        'name'              => 'admin',
        'email'             => 'admin@gmail.com',
        'mobile'            => '9720866645',
        'email_verified_at' => now(),
    ]);

    User::create([
        'secure_id'         => 'g9hj3wz2bk5u8d1p7tq0lmnv4s6x',
        'name'              => 'Kapil',
        'email'             => 'kapil@example.com',
        'mobile'            => '9646096546',
        'email_verified_at' => now(),
    ]);
    }
}
