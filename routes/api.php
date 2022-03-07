<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/products', [ProductController::class, 'getAllProducts'])->name('products');
Route::get('/products/{category_id}', [ProductController::class, 'getProductsByCategory'])->name('products.category');
Route::get('/single-product/{id}', [ProductController::class, 'getProductById'])->name('products.id');

Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'getCategoryById'])->name('categories.id');

Route::group(['middleware' =>'role:admin'], function (){
    Route::post('/add-product', [ProductController::class, 'addNewProduct'])->name('add-product');
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-product');
    Route::post('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::post('/add-category', [CategoryController::class, 'addNewCategory'])->name('add-category');
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
    Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');
});