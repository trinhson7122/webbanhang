<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
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

//user process
Route::controller(UserController::class)->group(function (){
    Route::name('user.')->group(function (){
        Route::post('user', 'store')->name('store');
        Route::delete('user/{user}', 'destroy')->name('destroy');
        Route::put('user/{user}', 'update')->name('update');
        Route::get('user/{user}', 'show')->name('show');
    });
});
//cart process
Route::controller(CartController::class)->group(function (){
    Route::name('cart.')->group(function (){
        Route::post('cart', 'store')->name('store');
        Route::delete('cart/{product_id}', 'destroy')->name('destroy');
    });
});
Route::post('find-coupon', [CouponController::class, 'find'])->name('coupon.find');

//client
Route::controller(IndexController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('cart', 'cart')->name('cart');
});
Route::middleware('client')->group(function () {
    //auth
    Route::get('logout', [AuthController::class, 'userLogout'])->name('auth.logout');
    //
    Route::get('profile', [IndexController::class, 'profile'])->name('profile');
    Route::get('myOrder', [IndexController::class, 'myOrder'])->name('myOrder');
    Route::get('checkout', [IndexController::class, 'checkout'])->name('checkout');
    Route::get('edit-profile/{id}', [UserController::class, 'show'])->name('profile.edit');
    Route::put('update-profile/{id}', [UserController::class, 'update'])->name('profile.update');

    Route::post('order', [OrderController::class, 'store'])->name('order.store');
    Route::get('success', [OrderController::class, 'store'])->name('order.store');
    Route::view('success', 'client.orderSuccess', ['title' => 'Thành công'])->name('order.success');
    
});
Route::middleware('not_client')->group(function () {
    //auth
    Route::get('login', [AuthController::class, 'userLogin'])->name('auth.login');
    Route::post('login', [AuthController::class, 'processUserLogin'])->name('auth.logining');
    Route::get('register', [AuthController::class, 'userRegister'])->name('auth.register');
    Route::post('register', [AuthController::class, 'processUserRegister'])->name('auth.registering');
    Route::get('auth/redirect/{provider}', [AuthController::class, 'socialiteRedirect'])->name('auth.socialite_redirect');
    Route::get('auth/callback/{provider}', [AuthController::class, 'socialiteCallback'])->name('auth.socialite_callback');
});
//
Route::middleware('not_admin')->group(function (){
    Route::get('admin/login', [AuthController::class, 'adminLogin'])->name('auth.admin_login');
    Route::post('admin/login', [AuthController::class, 'processAdminLogin'])->name('auth.admin_logining');
});
//admin
Route::middleware('admin')->group(function(){
    Route::prefix('admin')->group(function () {
        //product process
        Route::controller(ProductController::class)->group(function (){
            Route::name('product.')->group(function (){
                Route::post('product', 'store')->name('store');
                Route::delete('product/{product}', 'destroy')->name('destroy');
                Route::put('product/{product?}', 'update')->name('update');
                Route::get('product/{product}', 'show')->name('show');
            });
        });
        //coupon process
        Route::controller(CouponController::class)->group(function (){
            Route::name('coupon.')->group(function (){
                Route::post('coupon', 'store')->name('store');
                Route::delete('coupon/{coupon}', 'destroy')->name('destroy');
                Route::put('coupon/{coupon}', 'update')->name('update');
                Route::get('coupon/{coupon}', 'show')->name('show');
            });
        });
        //
        Route::name('admin.')->group(function (){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('product_manager', 'productManager')->name('product_manager');
                Route::get('user_manager', 'userManager')->name('user_manager');
                Route::get('coupon_manager', 'couponManager')->name('coupon_manager');
            });
        });

        Route::get('logout', [AuthController::class, 'adminLogout'])->name('auth.admin_logout');

    });
});