@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Quản Lý Sách</h1>
    <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary mb-3">Thêm Sách</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sách</th>
                <th>Tác Giả</th>
                <th>Giá</th>
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
                    <td>
                        <a href="{{ route('dashboard.books.edit', $book->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('dashboard.books.destroy', $book->id) }}" method="POST" style="display:inline;">
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
@endsection
