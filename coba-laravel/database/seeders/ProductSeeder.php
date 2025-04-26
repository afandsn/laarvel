<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Kemeja Flanel',
                'description' => 'Kemeja flanel hangat dan nyaman.',
                'stock' => 20,
                'image' => 'kemeja.jpg',
                'price' => 150000,
                'category_id' => 1,
            ],
            [
                'name' => 'Headphone',
                'description' => 'Headphone wireless bass mantap.',
                'stock' => 10,
                'image' => 'headphone.jpg',
                'price' => 300000,
                'category_id' => 2,
            ],
        ]);
    }
}