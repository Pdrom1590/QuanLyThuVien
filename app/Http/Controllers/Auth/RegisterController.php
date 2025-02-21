<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Tạo người dùng mới
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user', // Thiết lập vai trò là 'user'
    ]);

    // Nếu bạn cần thêm một bản ghi vào bảng carts, hãy chắc chắn rằng bạn có book_id
    // Nếu không cần, hãy bỏ qua đoạn này
    // Cart::create([
    //     'user_id' => $user->id,
    //     'book_id' => $someBookId, // Đảm bảo rằng bạn có giá trị cho book_id
    // ]);

    return redirect()->route('login')->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập.');
}
}