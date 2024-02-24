<?php
use App\Http\Controllers\ProductController;
Route::get('/', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('web');

?>