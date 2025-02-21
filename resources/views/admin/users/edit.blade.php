@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')
    <h1 class="mt-4">Chỉnh Sửa Người Dùng</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Thêm phương thức PUT để cập nhật -->

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật Khẩu</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu.</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
            <small class="form-text text-muted">Nhập lại mật khẩu để xác nhận.</small>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="role">Vai Trò</label>
            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Nhân Viên</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Người Dùng</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
@endsection
