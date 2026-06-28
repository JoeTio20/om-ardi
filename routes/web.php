<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhilosophyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Middleware\AdminAuth;

// ===== LANGUAGE =====
Route::get('/lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// ===== PUBLIC =====
Route::get('/',           [HomeController::class,       'index'])->name('home');
Route::get('/philosophy', [PhilosophyController::class, 'index'])->name('philosophy');
Route::get('/product',    [ProductController::class,    'index'])->name('product');

// ===== CART =====
Route::get('/cart',                  [CartController::class, 'index' ])->name('cart.index');
Route::post('/cart/add',             [CartController::class, 'add'   ])->name('cart.add');
Route::post('/cart/update',          [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',          [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear',           [CartController::class, 'clear' ])->name('cart.clear');

// ===== CHECKOUT =====
Route::get('/checkout',              [CheckoutController::class, 'index'  ])->name('checkout.index');
Route::post('/checkout',             [CheckoutController::class, 'store'  ])->name('checkout.store');
Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

// ===== ADMIN =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',   [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login',  [AdminAuthController::class, 'login'    ])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'   ])->name('logout');

    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('dashboard', [AdminProductController::class, 'dashboard'])->name('dashboard');
        Route::resource('products', AdminProductController::class)->names('products');
    });
});
