<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Traits\Filterable;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use Filterable;

    public function products()
    {
        return $this->belongsToMany(
            Product::class,          // Целевая модель
            (new ProductCategory())->getTable(),     // Промежуточная таблица
        );
    }
}
