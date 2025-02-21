@extends('layouts.client')
@section('title', 'THÔNG TIN CÁ NHÂN')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-5">Thông tin cá nhân</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu.</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <small class="form-text text-muted">Nhập lại mật khẩu để xác nhận.</small>
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                    <small class="form-text text-muted">Chọn ảnh đại diện mới (nếu có).</small>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
        <div class="col-6"><img style="max-width: 500px; width: 500px;" src="{{Auth::user()->avatar}}" alt=""></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
