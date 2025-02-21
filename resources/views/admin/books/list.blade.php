@extends('layouts.admin')

@section('title', 'Danh Sách Sách')

@section('content')
    <div class="container">
        <h1 class="mt-5">Danh Sách Sách</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('book.create') }}" class="btn btn-primary mb-3">Thêm Sách</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Giá</th>
                    <th>Tồn Kho</th>
                    <th>Thể Loại</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->status }}</td>
                        <td>
                            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('book.delete', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $books->links() }} <!-- Phân trang -->
    </div>
@endsection
