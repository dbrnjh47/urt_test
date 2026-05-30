<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends AbstractFilter
{
    public const ID = 'id';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::ID => [$this, 'id'],
            self::SEARCH => [$this, 'search'],
        ];
    }
    public function default(Builder $builder)
    {
    }
    public function search(Builder $builder, $value)
    {
        $builder->where(function ($q) use ($value) {
            $q->where("name", 'like', "%{$value}%");
        });
    }
    public function id(Builder $builder, $value)
    {
        $builder->where('id', $value);
    }
}
