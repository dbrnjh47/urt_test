<?php

namespace App\Models;

use App\Models\Product\Product;
use App\Models\Product\ProductPoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    /** @use HasFactory<\Database\Factories\PointFactory> */
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(
            Product::class,          // Целевая модель
            (new ProductPoint())->getTable(),     // Промежуточная таблица
        )->withPivot('count')
        ->orderByPivot('updated_at', 'desc');
    }
}
