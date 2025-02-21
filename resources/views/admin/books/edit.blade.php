@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Sửa Sách</h1>

    <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST') <!-- Sử dụng POST cho cập nhật -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên Sách</label>
            <input type="text" name="name" class="form-control" value="{{ $book->name }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Tác Giả</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $book->price }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Tồn Kho</label>
            <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea name="description" class="form-control" rows="3">{{ $book->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh Mới (nếu có)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Thể Loại</label>
            <select name="category" class="form-control" required>
                <option value="">Chọn thể loại</option>
                <option value="sach" {{ $book->category == 'sach' ? 'selected' : '' }}>Sách</option>
                <option value="van_phong_pham" {{ $book->category == 'van_phong_pham' ? 'selected' : '' }}>Văn Phòng Phẩm</option>
                <option value="do_dien_tu" {{ $book->category == 'do_dien_tu' ? 'selected' : '' }}>Đồ Điện Tử</option>
                <option value="thoi_trang" {{ $book->category == 'thoi_trang' ? 'selected' : '' }}>Thời Trang</option>
                <option value="do_choi" {{ $book->category == 'do_choi' ? 'selected' : '' }}>Đồ Chơi</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" required>
        </div>
        <div class="mb-3">
            <label for="published_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" name="published_date" class="form-control" value="{{ $book->published_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Sách</button>
    </form>
@endsection
