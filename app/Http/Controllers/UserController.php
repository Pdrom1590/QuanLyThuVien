<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }




public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'is_admin' => 'boolean',
        'is_staff' => 'boolean', // Thêm validate cho is_staff
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'is_admin' => $request->is_admin ?? false,
        'is_staff' => $request->is_staff ?? false, // Thêm is_staff vào đây
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
}
  public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    public function edit($id)
{
    $user = User::findOrFail($id);
    return response()->json($user);
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'is_admin' => 'required|boolean',
        'is_staff' => 'required|boolean', // Thêm validate cho is_staff
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->is_admin = $request->is_admin;
    $user->is_staff = $request->is_staff; // Thêm is_staff vào đây

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}
}