@extends('layouts.client')
@section('title', 'Đăng nhập')
@section('login')
<div class="w-50 mx-auto">
<form action="" method="POST">
    <h1>Đăng nhập vào thư viện</h1>
    @csrf
    {{-- <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div> --}}
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
    </div>
    <div class="row py-3">
        <button class="col-4 btn btn-primary" type="submit" class="btn btn-primary">Đăng nhập</button>
        <p class="col-8" >Chưa có tài khoản? <a href="{{route('register')}}">Đăng ký</a> ngay</p>
    </div>
</form>
</div>
@endsection
