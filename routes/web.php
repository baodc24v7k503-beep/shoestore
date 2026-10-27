<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\UserOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Middleware\CheckAdmin;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/danh-muc/{id}', [HomeController::class, 'category'])->name('danh-muc');
Route::get('/san-pham/{id}', [HomeController::class, 'product'])->name('san-pham');
Route::get('/dang-nhap', [HomeController::class, 'login'])->name('dang-nhap');
Route::get('/dang-ky', [HomeController::class, 'register'])->name('dang-ky');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('lien-he');
Route::get('/gio-hang', [HomeController::class, 'cart'])->name('gio-hang');
Route::get('/dieu-khoan', [HomeController::class, 'faq'])->name('dieu-khoan');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('product.search');

Route::post('add-to-cart', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::get('/thanh-toan', [CheckoutController::class, 'checkout'])->name('checkout.index');
Route::post('/thanh-toan', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/dat-hang-thanh-cong', [CheckoutController::class, 'success'])->name('checkout.success');

Route::post('/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('coupon.apply');
Route::get('/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');

Route::get('/get-variants/{id}', [ProductVariantsController::class, 'getVariants'])->name('get.variants');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/my_order', [UserOrderController::class, 'index'])->name('user.orders');
    Route::get('/my_order/{id}', [UserOrderController::class, 'show'])->name('user.orders.detail');
});

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    
    Route::prefix('products/{product_id}/variants')->name('variants.')->group(function () {
        Route::get('/', [ProductVariantsController::class, 'index'])->name('index');
        Route::post('/', [ProductVariantsController::class, 'store'])->name('store');
        Route::delete('/{id}', [ProductVariantsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
        Route::post('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/update-role/{id}', [UserController::class, 'updateRole'])->name('updateRole');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::resource('coupons', CouponController::class);
});