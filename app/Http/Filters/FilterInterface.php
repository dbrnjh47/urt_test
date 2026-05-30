<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $builder);
    public function default(Builder $builder);
}
