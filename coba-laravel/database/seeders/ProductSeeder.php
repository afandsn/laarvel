<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Kemeja Flanel',
                'description' => 'Kemeja flanel hangat dan nyaman.',
                'stock' => 20,
                'image' => 'kemeja.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Headphone',
                'description' => 'Headphone wireless bass mantap.',
                'stock' => 10,
                'image' => 'headphone.jpg',
                'category_id' => 1,
            ],
        ]);        
    }
}
