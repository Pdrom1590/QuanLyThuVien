@extends('layouts.staff')

@section('content')
    @vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->
    <h1 class="mt-5">Danh Sách Sách</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($books->isEmpty())
        <p>Không có sách nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Ngày Xuất Bản</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('d/m/Y') : 'Chưa có' }}</td>
                        <td>
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" style="width: 50px; height: auto;">
                            @else
                                <span>Không có hình ảnh</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('staff.books.edit', $book->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('staff.books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('staff.books.create') }}" class="btn btn-primary">Thêm Sách Mới</a>
@endsection
