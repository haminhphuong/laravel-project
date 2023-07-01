<?php

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
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as FEProductController;
use App\Http\Controllers\ReviewController as FEReviewController;
use App\Http\Controllers\UserController as FEUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController as FECategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\AccountController;

Route::prefix('/')->group(function () {
    // Register
    Route::get('/register', [FEUserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [FEUserController::class, 'register'])->name('post.register');

    // Login
    Route::get('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('login', 'App\Http\Controllers\AuthController@postLogin')->name('postLogin');

    // Logout
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/products/{id}', [FEProductController::class,'show'])->name('products.show');
    Route::post('/products/{product_id}/reviews', [FEReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

    Route::get('category/{slug}', [FECategoryController::class,'showProducts'])->name('category.products');


    Route::post('/add-to-cart/{id}', [CartController::class,'addToCart'])->name('cart.add')->middleware('auth');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'updateCart']);

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
    Route::get('/confirm-order/{id}', [CheckoutController::class, 'confirmOrder'])->name('order.confirm');

    Route::get('/api/get-districts/{province_id}', [CheckoutController::class, 'getDistrictsByProvince']);
    Route::get('/api/get-wards/{district_id}', [CheckoutController::class, 'getWardsByDistrict']);

    Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');
    Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');

});

// Routes cho nhóm admin
Route::get('admin/login', [AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class,'login'])->name('admin.login.submit');
Route::get('admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

//Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
//    // Thêm các routes cho nhóm admin tại đây
//});

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['admin.auth']], function () {
    Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class,'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class,'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');

    Route::get('products', [ProductController::class,'index'])->name('products.index');
    Route::get('products/create', [ProductController::class,'create'])->name('products.create');
    Route::post('products', [ProductController::class,'store'])->name('products.store');
    Route::get('products/{id}', [ProductController::class,'show'])->name('products.show');
    Route::get('products/{id}/edit', [ProductController::class,'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class,'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class,'destroy'])->name('products.destroy');
    Route::post('products/images/{id}/remove', [ProductController::class, 'removeImage'])->name('products.removeImage');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/{id}', [OrderController::class, 'viewOrder'])->name('orders.view');
    Route::get('orders/{id}/edit', [OrderController::class, 'editOrder'])->name('orders.edit');
    Route::post('orders/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/{order}/ship', [OrderController::class, 'ship'])->name('orders.ship');
    Route::post('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('admin.customers.show');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
});

