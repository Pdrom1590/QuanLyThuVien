@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Quản Lý Người Dùng</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Thêm Người Dùng</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai Trò</th>
                <th>Ngày Tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td> <!-- Hiển thị vai trò -->
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td> <!-- Hiển thị ngày tạo tài khoản -->
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
