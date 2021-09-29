<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'books',
                'sort_order' => 1
            ],
            [
                'name' => 'foods',
                'sort_order' => 2
            ],
            [
                'name' => 'clothing',
                'sort_order' => 3
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'primary_category_id' => 1,
                'name' => 'Laravel',
                'sort_order' => 1
            ],
            [
                'primary_category_id' => 1,
                'name' => 'CakePHP',
                'sort_order' => 2
            ],
            [
                'primary_category_id' => 1,
                'name' => 'Symfony',
                'sort_order' => 3
            ],
            [
                'primary_category_id' => 2,
                'name' => 'Alcohol',
                'sort_order' => 1
            ],
            [
                'primary_category_id' => 2,
                'name' => 'Meet',
                'sort_order' => 2
            ],
            [
                'primary_category_id' => 2,
                'name' => 'Fish',
                'sort_order' => 3
            ],
        ]);
    }
}
