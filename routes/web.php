<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

//  Public Pages
Route::view('/', 'index');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/search', 'search')->name('search');

//  Cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', fn () => view('cart'))->name('cart');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//  Clear Cart (for testing)
Route::get('/clear-cart', function () {
    session()->forget('cart');
    return redirect('/cart')->with('success', 'Cart cleared!');
});

// Product Pages by Category and Detail
Route::get('/vegetables', [ProductController::class, 'showByCategory'])->defaults('categoryName', 'Vegetables');
Route::get('/fruits', [ProductController::class, 'showByCategory'])->defaults('categoryName', 'Fruits');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Offers Page - Show products that are on sale
Route::get('/offers', function () {
    $offers = Product::with('category')->where('on_sale', true)->get();
    return view('offers', compact('offers'));
})->name('offers');

//  Auth Routes (Jetstream UI)
Route::get('/login', fn () => view('login'))->middleware('guest')->name('login');
Route::get('/register', fn () => view('register'))->middleware('guest')->name('register');

//  Authenticated User Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/account', [OrderController::class, 'accountPage'])->name('account');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
    Route::get('/order-confirmation', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');
});

//  Admin Auth Routes (custom session-based)
Route::get('/admin/login', fn () => view('admin.login'))->middleware('guest')->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'handleLogin'])->name('admin.login.submit');
Route::post('/admin/logout', function () {
    session()->forget('is_admin_logged_in');
    return redirect()->route('admin.login');
})->name('admin.logout');

//  Admin Panel Routes (protected by middleware)
Route::middleware('admin.auth')->prefix('admin')->group(function () {

    //  Admin Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //  Add Product & Category Forms
    Route::get('/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::get('/category/create', [AdminController::class, 'createCategory'])->name('admin.category.create');

    // Category Management
    Route::post('/category', [AdminController::class, 'addCategory'])->name('admin.addCategory');
    Route::get('/category/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.category.edit');
    Route::put('/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/category/{id}/delete', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');

    //  Product Management
    Route::post('/product', [AdminController::class, 'addProduct'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/product/{id}/delete', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');

    //  Order Management
    Route::get('/orders', [AdminController::class, 'viewOrders'])->name('admin.orders');
    Route::post('/orders/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');
});
