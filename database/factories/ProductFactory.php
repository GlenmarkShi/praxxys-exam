<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::pluck('id');
        return [
            'name' => fake()->unique()->word(),
            'categoryID' => fake()->randomElement($category),
            'description' =>fake()->unique()->sentence(),
            'date_time' => Carbon::now(),
        ];
    }
}
