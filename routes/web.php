<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoadController;

Route::get('/', function () {
    return redirect('login');
});

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/loads/product', [App\Http\Controllers\LoadController::class, 'addProduct'])->name('loads.add');
Route::get('/loads/product', [App\Http\Controllers\LoadController::class, 'showAddProduct'])->name('loads.product.show');
Route::post('/loads/close', [App\Http\Controllers\LoadController::class, 'closeLoad'])->name('loads.close');
Route::get('/loads/index', [App\Http\Controllers\LoadController::class, 'indexLoad'])->name('loads.indexLoad');

// Route::get('/test', [App\Http\Controllers\LoadController::class, 'test'])->name('test');

Route::get('/loads/{id}/product', [App\Http\Controllers\LoadController::class, 'registerProduct'])->name('loads.registerProduct');

Route::get('/generate/pdf/loads/{id}', [App\Http\Controllers\LoadController::class, 'generatePDF'])->name('loads.generatePDF');

Route::delete('/loads/product/{id}', [App\Http\Controllers\LoadController::class, 'deleteProductLoad'])->name('loads.deleteProductLoad');

Route::resources([
    'users' => UserController::class,
    'products' => ProductController::class,
    'loads' => LoadController::class,
]);
