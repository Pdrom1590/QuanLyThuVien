<!-- resources/views/staff/books/create.blade.php -->
@extends('layouts.staff')

@section('content')
@vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->
    <h1 class="mt-5">Thêm Sách Mới</h1>

    <form action="{{ route('staff.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên Sách</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="author">Tác Giả</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="stock">Số Lượng</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Hình Ảnh</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
        </div>
        <div class="form-group">
            <label for="published_date">Ngày Xuất Bản</label>
            <input type="date" class="form-control" id="published_date" name="published_date">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sách</button>
    </form>
@endsection
