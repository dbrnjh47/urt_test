<?php

namespace Database\Seeders\Product;

use App\Models\Category;
use App\Models\Point;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductPoint;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 6; $i++) {
            Product::factory(rand(10, 30))
                ->afterCreating(function (Product $product) {
                    $categoryIds = Category::inRandomOrder()
                        ->limit(rand(0, 3))
                        ->pluck('id')
                        ->toArray();

                    foreach ($categoryIds as $categoryId) {
                        ProductCategory::firstOrCreate([
                            'category_id' => $categoryId,
                            'product_id' => $product->id,
                        ]);
                    }
                })
                ->afterCreating(function (Product $product) {
                    $pointIds = Point::inRandomOrder()
                        ->limit(rand(0, 2))
                        ->pluck('id')
                        ->toArray();

                    foreach ($pointIds as $pointId) {
                        ProductPoint::firstOrCreate([
                            'point_id' => $pointId,
                            'product_id' => $product->id,
                            'count' => rand(1,100)
                        ]);
                    }
                })
                ->create();
        }
    }
}
