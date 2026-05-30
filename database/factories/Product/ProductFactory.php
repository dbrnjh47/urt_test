<?php

namespace Database\Factories\Product;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Product>
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
        return [
            "name" => fake()->text(rand(5, 20)),
            "price" => fake()->randomFloat(2, 10, 1000),
        ];
    }
}
