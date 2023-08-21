<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/admin/brand', BrandController::class);
    Route::resource('/admin/product', ProductController::class);
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/customer', CustomerController::class);
    Route::resource('/admin/order', OrderController::class);

    Route::delete('/delete-selected-categories', [CategoryController::class, 'deleteMultipleCategories'])->name('category.multiple-delete');
    Route::delete('/delete-selected-brands', [BrandController::class, 'deleteMultipleBrands'])->name('brand.multiple-delete');
    Route::delete('/delete-selected-products', [ProductController::class, 'deleteMultipleProducts'])->name('product.multiple-delete');
    Route::delete('/delete-selected-customers', [CustomerController::class, 'deleteMultipleCustomers'])->name('customer.multiple-delete');
});

require __DIR__ . '/auth.php';

Route::get('/verifyuser', [VerifyUserController::class, 'verifyuser'])->middleware(['auth', 'verified'])->name('verifyuser');

Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/home', 'home')->name('home');
    Route::get('/admin/dashboard', 'dashboard')->name('dashboard');
    Route::get('/admin/profile', 'editProfile')->name('profile');
})->middleware(['auth', 'verified']);

Route::controller(UserController::class)->name('user.')->group(function () {
    Route::get('/home', 'home')->name('home');

});