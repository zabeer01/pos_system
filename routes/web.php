<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



//products
Route::get('/products/pos-system', [ProductController::class, 'posSystem'])->name('pos_system');
Route::resource('products', ProductController::class);

