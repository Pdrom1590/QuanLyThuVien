<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Routes cho khách
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('/books', [BookController::class, 'showListBook'])->name('books.list');
Route::get('/books/search', [BookController::class, 'showListBook'])->name('books.search');
Route::get('/books/filter', [BookController::class, 'showListBook'])->name('books.filter');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Khi đã đăng nhập
Route::group(['middleware' => 'auth'], function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);

    // Giỏ hàng
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

    // Đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Danh sách đơn hàng của người dùng
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // Tạo đơn hàng mới
    Route::resource('orders', OrderController::class);
    // Định nghĩa route cho việc cập nhật trạng thái đơn hàng
    Route::put('orders/{id}/updateStatus', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Xóa đơn hàng
    Route::get('/orders/{id}/payment', [OrderController::class, 'showPaymentForm'])->name('orders.payment.show'); // Hiển thị form thanh toán
    Route::post('/orders/{id}/payment', [OrderController::class, 'processPayment'])->name('orders.payment.process'); // Xử lý thanh toán
    Route::get('/books/{id}/order', [OrderController::class, 'create'])->name('orders.create');// Route để hiển thị form đặt hàng cho một quyển sách
});

// Routes cho admin
Route::group(['middleware' => ['checkrole:admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Quản lý sách
    Route::get('/dashboard/books', [BookController::class, 'index'])->name('dashboard.books.index'); // Danh sách sách
    Route::get('/dashboard/books/create', [BookController::class, 'create'])->name('dashboard.books.create'); // Hiển thị form tạo sách
    Route::post('/dashboard/books', [BookController::class, 'store'])->name('dashboard.books.store'); // Thêm sách
    Route::get('/dashboard/books/{id}/edit', [BookController::class, 'edit'])->name('dashboard.books.edit'); // Hiển thị form sửa sách
    Route::put('/dashboard/books/{id}', [BookController::class, 'update'])->name('dashboard.books.update'); // Cập nhật sách
    Route::delete('/dashboard/books/{id}', [BookController::class, 'destroy'])->name('dashboard.books.destroy'); // Xóa sách

    //Quản lý người dùng
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('admin.users.index'); // Danh sách người dùng
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('admin.users.create'); // Hiển thị form tạo người dùng
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('admin.users.store'); // Thêm người dùng
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // Xóa người dùng
    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // Hiển thị form sửa người dùng
    Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('admin.users.update'); // Cập nhật người dùng

    // Quản lý đơn hàng
    Route::get('/dashboard/order', [OrderController::class,'adminIndex'])->name('admin.orders.index'); // Danh sách đơn hàng
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    // Thống kê
    Route::get('/dashboard/statistics', [BookController::class, 'showStatistics'])->name('admin.statistics'); // Hiển thị thống kê sách
});

// Routes cho staff
Route::group(['middleware' => ['admin_or_staff']], function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard'); // Trang dashboard cho staff
    })->name('staff.dashboard');

    // Quản lý sách (staff có thể xem, tạo, sửa sách)
    Route::get('/staff/books', [BookController::class, 'staffbook'])->name('staff.books.index'); // Danh sách sách
    Route::get('/staff/books/create', [BookController::class, 'create'])->name('staff.books.create'); // Hiển thị form tạo sách
    Route::post('/staff/books', [BookController::class, 'store'])->name('staff.books.store'); // Thêm sách
    Route::get('/staff/books/{id}', [BookController::class, 'show'])->name('staff.books.show'); // Chi tiết sách
    Route::get('/staff/books/{id}/edit', [BookController::class, 'edit'])->name('staff.books.edit'); // Hiển thị form sửa sách
    Route::put('/staff/books/{id}', [BookController::class, 'update'])->name('staff.books.update'); // Cập nhật sách
    Route::delete('/staff/books/{id}', [BookController::class, 'destroy'])->name('staff.books.destroy'); // Xóa sách

    // Quản lý đơn hàng
    Route::get('/staff/orders', [OrderController::class, 'staffIndex'])->name('staff.orders.index'); // Danh sách đơn hàng
    Route::post('/staff/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('staff.orders.updateStatus');
    Route::post('/staff/orders/{id}/confirm', [OrderController::class, 'confirmOrder'])->name('staff.orders.confirm'); // Xác nhận đơn hàng
});