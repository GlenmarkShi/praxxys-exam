<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Apple',
            'categoryID' => 1,
            'description' => 'red apple',
            'date_time' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Banana',
            'categoryID' => 1,
            'description' => 'yellow banana',
            'date_time' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Summit',
            'categoryID' => 2,
            'description' => 'water',
            'date_time' => Carbon::now(),
        ]);
    }
}
