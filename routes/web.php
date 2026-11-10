<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerOrderController;

// Home Page
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

    // About Us Page
Route::view('/about', 'about')->name('about');

// Customer Product Pages
Route::get('/products', [ProductPageController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductPageController::class, 'show'])
    ->name('products.show');

    // Contact Us
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.submit');

// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');

});

// Authenticated User Routes
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

            // Customer Dashboard
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');

        // Customer Order History & Details
Route::get('/customer/orders', [CustomerOrderController::class, 'index'])
    ->name('customer.orders.index');

Route::get('/customer/orders/{order}', [CustomerOrderController::class, 'show'])
    ->name('customer.orders.show');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.place');

    // Order Confirmation
    Route::get('/order-confirmation/{order}', [CheckoutController::class, 'success'])
        ->name('checkout.success');

});

// Shopping Cart Routes
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/update/{itemId}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])
    ->name('cart.remove');

// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Category Management
        Route::resource('categories', CategoryController::class);

        // Product Management
        Route::resource('products', ProductController::class);

        // Order Management
        Route::resource('orders', OrderController::class)
            ->only(['index', 'show', 'update']);

    });

    // Admin Contact Messages
Route::get('/admin/contact-messages', [ContactMessageController::class, 'index'])
    ->name('admin.contact-messages.index');

Route::get('/admin/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
    ->name('admin.contact-messages.show');

Route::patch('/admin/contact-messages/{contactMessage}', [ContactMessageController::class, 'update'])
    ->name('admin.contact-messages.update');

Route::delete('/admin/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
    ->name('admin.contact-messages.destroy');
    