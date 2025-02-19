<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Nhập mô hình User

class ProfileController extends Controller
{
    // Hiển thị thông tin cá nhân
    public function index()
    {
        return view('client.profile', ['user' => Auth::user()]);
    }

    // Cập nhật thông tin cá nhân
public function update(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'email' => 'required|email|unique:users,email,' . Auth::id(), // Đảm bảo email là duy nhất, ngoại trừ người dùng hiện tại
        'password' => 'nullable|string|confirmed', // Nếu có trường password, yêu cầu xác nhận
    ]);
    //Thêm cái dưới vào cứu cả bài ((=
/** @var \App\Models\User $user **/
    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->hasFile('avatar')) {
        if ($user->avatar) {
            $oldAvatarPath = public_path($user->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = '/storage/' . $path; // Cập nhật đường dẫn ảnh
    }
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }
    $user->save();

    // Chuyển hướng về trang hồ sơ với thông báo thành công
    return redirect()->route('profile')->with('success', 'Thông tin đã được cập nhật!');
}
}