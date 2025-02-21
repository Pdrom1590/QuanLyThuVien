@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Thêm Sách Mới</h1>

    <form action="{{ route('dashboard.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Sách</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Tác Giả</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Tồn Kho</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Thể Loại</label>
            <select name="category" class="form-control" required>
                <option value="">Chọn thể loại</option>
                <option value="sach">Sách</option>
                <option value="van_phong_pham">Văn Phòng Phẩm</option>
                <option value="do_dien_tu">Đồ Điện Tử</option>
                <option value="thoi_trang">Thời Trang</option>
                <option value="do_choi">Đồ Chơi</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="published_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" name="published_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sách</button>
    </form>
@endsection
