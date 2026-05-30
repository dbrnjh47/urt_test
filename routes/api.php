<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'list'])->name('api.product.list');
// ->middleware('auth:sanctum');
