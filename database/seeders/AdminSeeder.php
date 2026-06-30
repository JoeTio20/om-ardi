<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['email' => 'tionatajoe@gmail.com'],
            [
                'name'       => 'JOE',
                'password'   => Hash::make('joe123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}