<?php

namespace App\Models\Product;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductFactory> */
    use HasFactory;
    use Filterable;

    // воспользовался has, поскольку задача позволяет и уменьшает подзапросы по сравнению с belongs
    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }

    public function product_category()
    {
        return $this->hasOne(ProductCategory::class, 'product_id', 'id');
    }

    public function product_point()
    {
        return $this->hasOne(ProductPoint::class, 'product_id', 'id');
    }
}
