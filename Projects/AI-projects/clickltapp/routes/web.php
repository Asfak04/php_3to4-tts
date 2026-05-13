<?php

use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/career', 'career')->name('career');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/404', 'error404')->name('error.404');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product');
    Route::get('/product-details/{id}', 'PoductsDetails')->name('product.details');
    Route::get('/cart', 'cart')->name('cart');
    Route::post('/add-to-cart', 'addToCart')->name('add.to.cart');
    Route::patch('/update-cart', 'updateCart')->name('update.cart');
    Route::delete('/remove-from-cart', 'removeFromCart')->name('remove.from.cart');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ProductController::class)->group(function () {
        Route::post('/checkout', 'checkout')->name('checkout');
        Route::post('/razorpay/order', 'createRazorpayOrder')->name('razorpay.order');
        Route::post('/razorpay/callback', 'verifyRazorpayPayment')->name('razorpay.callback');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/orders/{order}/invoice', 'downloadInvoice')->name('orders.downloadInvoice');
    });

    // Admin Routes
    Route::middleware(['is_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Category CRUD
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        
        // Product CRUD
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::delete('/products/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.deleteImage');
        
        // Order Management
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});



require __DIR__.'/auth.php';
