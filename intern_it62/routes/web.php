<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/submit', [LoginController::class, 'submit'])->name('login_submit')->middleware('localhostonly');

Route::middleware(['auth', 'activeonly'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/search', [UserController::class, 'search'])->name('users_search');
    Route::post('/users/store', [UserController::class, 'store'])->name('users_store');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users_update');
    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users_delete');
    Route::get('/users/lock/{id}', [UserController::class, 'lock'])->name('users_lock');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers_search');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers_store');
    Route::post('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers_update');
    Route::get('/customers/delete/{id}', [CustomerController::class, 'delete'])->name('customers_delete');
    Route::get('/customers/lock/{id}', [CustomerController::class, 'lock'])->name('customers_lock');
    Route::post('/customers/import', [CustomerController::class, 'import'])->name('customers_import');
    Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers_export');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/delete-image', [ProductController::class, 'deleteImage'])->name('products_delete_image');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products_search');
    Route::get('/products/add', [ProductController::class, 'add'])->name('products_add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products_store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products_edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products_update');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products_delete');
    Route::get('/products/lock/{id}', [ProductController::class, 'lock'])->name('products_lock');
});
