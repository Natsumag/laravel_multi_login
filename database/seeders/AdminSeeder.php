<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'test',
            'email' => 'test1@test.com',
            'password' => Hash::make('passwordhoge'),
            'created_at' => date('Y/m/d H:m:s')
        ]);
    }
}
