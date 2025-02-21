<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Lấy danh sách người dùng
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Hiển thị form tạo người dùng
        return view('admin.users.create'); // Tạo view cho form tạo người dùng
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,staff,user', // Validate cho role
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Lưu role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User  added successfully.');
    }

    public function edit($id)
    {
        // Hiển thị form sửa người dùng
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user')); // Tạo view cho form sửa người dùng
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,staff,user', // Validate cho role
        ]);

        // Cập nhật thông tin người dùng
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role; // Cập nhật role

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User  updated successfully.');
    }

    public function destroy($id)
    {
        // Xóa người dùng
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User  deleted successfully.');
    }
}