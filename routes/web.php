<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');   
});

route::resource('products', ProductsController::class);

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');

route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');

route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');

route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');

route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');

route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');


