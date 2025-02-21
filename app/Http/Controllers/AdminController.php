<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count(); // Tổng số sách
        $totalOrders = Order::count(); // Tổng số đơn hàng
        $featuredBooks = Book::orderBy('created_at', 'desc')->take(5)->get(); // Lấy 5 sách mới nhất

        return view('admin.dashboard', compact('totalBooks', 'totalOrders', 'featuredBooks'));
    }
}