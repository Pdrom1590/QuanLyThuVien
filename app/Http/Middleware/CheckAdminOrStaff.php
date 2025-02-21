<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrStaff
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        // Kiểm tra xem người dùng có vai trò là 'admin' hoặc 'staff' không
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'staff') {
            return $next($request); // Tiếp tục với request nếu vai trò hợp lệ
        }

        // Nếu không có quyền, chuyển hướng về trang khác hoặc hiển thị thông báo lỗi
        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập.');
    }
}