<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'CategoryName' => 'Fruit',
        ]);
        Category::create([
            'CategoryName' => 'Beverages',
        ]);
        Category::create([
            'CategoryName' => 'Food',
        ]);
        Category::create([
            'CategoryName' => 'Electronics',
        ]);
        Category::create([
            'CategoryName' => 'Appliances',
        ]);
        
    }
}
