<?php

namespace App\Models\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductCategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id',
    ];
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
