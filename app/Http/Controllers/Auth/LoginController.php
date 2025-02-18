<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }
        public function Login(request $request){
            $email = $request->email;
            $password = $request->password;
            $status = Auth::attempt(['email'=> $email,'password'=> $password]);
            if($status){
                $user = Auth::user();
                $urlRedirect="/";
                if($user->is_admin == true){
                    $urlRedirect= "dashboard";
                }else{
                } return redirect($urlRedirect);
            }
            return back()->with('msg','Mày đã nhập sai mật khẩu hoặc email rồi!!!');
        }
public function logout(Request $request){
    Auth::logout();
    return redirect('/login')->with('msg', 'Bạn đã đăng xuất thành công.');
}
}
