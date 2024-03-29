<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('passwordhoge'),
                'created_at' => date('Y/m/d H:m:s')
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('passwordhoge'),
                'created_at' => date('Y/m/d H:m:s')
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('passwordhoge'),
                'created_at' => date('Y/m/d H:m:s')
            ],
        ]);
    }
}
