<?php

use App\Http\Controllers\AuthController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/search/{name}', [ProductController::class, 'search'])->name('products.search');

// Route::resource('products', ProductController::class);

// protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::get('/products', [ProductController::class, 'index']);
// Route::post('/products', [ProductController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
