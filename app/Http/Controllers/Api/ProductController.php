<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\ListRequest;
use App\Models\Product\Product;

class ProductController extends Controller
{
    public function list(ListRequest $request)
    {
        $page = $request->get('page', 1);

        $productFilter = app()->make(ProductFilter::class, ['params' => array_filter($request->validated())]);

        $products = Product::filter($productFilter)
            ->paginate(10, page:$page);

        // return view("welcome", compact("products"));
        return response()->json($products);
    }
}
