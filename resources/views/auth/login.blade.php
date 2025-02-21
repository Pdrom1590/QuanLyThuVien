@extends('layouts.client')

@section('content')
    <h1 class="mt-5">Đăng Nhập</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật Khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        <a href="{{ route('register') }}" class="btn btn-link">Đăng Ký</a>
    </form>
@endsection
