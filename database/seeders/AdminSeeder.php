<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('admins')->where('email', 'admin@sarangburung.com')->doesntExist()) {
            DB::table('admins')->insert([
                'name'       => 'JOE',
                'email'      => 'tionatajoe@gmail.com',
                'password'   => Hash::make('joe123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
