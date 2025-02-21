@extends('layouts.staff')

@section('content')
@vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->
    <div class="container mt-5">
        <h1 class="mb-4">Sửa Sách</h1>

        <form action="{{ route('staff.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên Sách</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $book->name }}" required>
            </div>

            <div class="form-group">
                <label for="author">Tác Giả</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
            </div>

            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}" required>
            </div>

            <div class="form-group">
                <label for="stock">Số Lượng</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ $book->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Hình Ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <small class="form-text text-muted">Để lại trống nếu không muốn thay đổi hình ảnh.</small>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
            </div>

            <div class="form-group">
                <label for="published_date">Ngày Xuất Bản</label>
                <input type="date" class="form-control" id="published_date" name="published_date" value="{{ $book->published_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Sách</button>
            <a href="{{ route('staff.books.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
@endsection
