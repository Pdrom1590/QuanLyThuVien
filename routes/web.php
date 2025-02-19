<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
//View của guest
    Route::get('/books', [ProductController::class, 'showListBook'])->name('books');
    Route::get('/books/search', [ProductController::class, 'showListBook'])->name('books.search');
    Route::get('/books/filter', [ProductController::class, 'showListBook'])->name('books.filter');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Khi đã đăng nhập
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('client.home');
    })->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    // Cart
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    //Cart navbar
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
});

// Đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Các route cho admin
Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Product
    Route::get('/dashboard/product', [ProductController::class, 'showListProduct'])->name('products.list');
    Route::get('/dashboard/product/create', function () {
        return view('admin.products.create');
    })->name('product.create');
    Route::post('/product/store', [ProductController::class, 'submit'])->name('product.store');
    Route::get('/dashboard/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/dashboard/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/dashboard/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // User
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::resource('admin/users', UserController::class);
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Reset password
    Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
});
