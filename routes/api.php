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


// user register-login routes
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

// product routes
Route::get('/products', [ProductController::class, 'getAllProducts'])->name('products');
Route::get('/products/{category_id}', [ProductController::class, 'getProductsByCategory'])->name('products.category');
Route::get('/single-product/{id}', [ProductController::class, 'getProductById'])->name('products.id');

// category routes
Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'getCategoryById'])->name('categories.id');

// admin routes
Route::group(['middleware' =>'role:admin'], function (){
    Route::post('/add-product', [ProductController::class, 'addNewProduct'])->name('add-product');  // add new product
    Route::post('/add-products', [ProductController::class, 'addNewProducts'])->name('add-products'); // for bulk upload
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-product');  // update product
    Route::post('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');  // delete product
    Route::post('/add-category', [CategoryController::class, 'addNewCategory'])->name('add-category');  // add new category
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');  // update category
    Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');  // delete category
});