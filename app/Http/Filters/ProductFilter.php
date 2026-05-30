<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const CATEGORY_ID = 'category_id';
    public const POINT_ID = 'point_id';
    public const SEARCH = 'search';
    public const PRICE = 'price';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::POINT_ID => [$this, 'pointId'],
            self::SEARCH => [$this, 'search'],
            self::PRICE => [$this, 'price'],
        ];
    }

    public function default(Builder $builder) {}
    public function price(Builder $builder, $array)
    {
        $minPrice = $array[0] ?? null;
        $maxPrice = $array[1] ?? null;

        if ($minPrice > 0) {
            $builder->where('price', '>=', $minPrice);
        }

        if ($maxPrice > 0) {
            $builder->where('price', '<=', $maxPrice);
        }
    }

    public function search(Builder $builder, $value)
    {
        $builder->where(function ($q) use ($value) {
            $q->where("name", 'like', "%{$value}%");
        });
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->whereHas('product_category', function ($query) use ($value) {
            $query->where('category_id', $value);
        });
    }

    public function pointId(Builder $builder, $value)
    {
        $builder->whereHas('product_point', function ($query) use ($value) {
            $query->where('point_id', $value);
        });
    }
}
