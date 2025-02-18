<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleGroup;


class RoleGroupSeeder extends Seeder
{
    public function run(): void
    {
        RoleGroup::create([
            'role_name' => 'Employee',
        ]);

        RoleGroup::create([
            'role_name' => 'Admin',
        ]);

    }
}
