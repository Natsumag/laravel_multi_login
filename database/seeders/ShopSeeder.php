<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'テスト店名1',
                'information' => 'テスト店舗情報2',
                'filename' => '',
                'is_selling' => true
            ],
            [
                'owner_id' => 2,
                'name' => 'テスト店名2',
                'information' => 'テスト店舗情報2',
                'filename' => '',
                'is_selling' => true
            ],
        ]);
    }
}
