@extends('layouts.client')
@section('title', 'SÁCH CỦA THƯ VIỆN')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        transition: transform 0.2s;
        height: 100%; /* Đảm bảo chiều cao card bằng nhau */
    }
    .product-card:hover {
        transform: scale(1.05);
    }
    .product-card img {
        height: 250px; /* Đảm bảo tất cả hình ảnh có cùng chiều cao */
        object-fit: cover; /* Cắt hình ảnh theo tỷ lệ */
    }
    .card-body {
        text-align: center; /* Canh giữa văn bản trong thẻ card */
    }
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center; /* Căn giữa theo chiều dọc */
        margin: 20px 0; /* Khoảng cách trên và dưới */
    }
    .pagination .page-item {
        margin: 0 5px; /* Khoảng cách giữa các nút phân trang */
    }
    .pagination .page-link {
        padding: 10px 15px; /* Tăng kích thước nút */
        text-align: center; /* Căn giữa chữ trong nút */
    }
    .pagination .page-link:hover {
        background-color: #007bff; /* Màu nền khi hover */
        color: white; /* Màu chữ khi hover */
    }
</style>

<div class="container">
    <h1 class="mt-5 text-center">Danh sách Sách</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <form action="{{ route('books.list') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sách theo tên" value="{{ request()->get('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm</button>
        </div>
    </form>

    <div class="row">
        @if($books->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted">Không có sản phẩm nào.</p>
            </div>
        @else
            @foreach($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        <img
                            src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-image.jpg') }}"
                            class="card-img-top"
                            alt="{{ $book->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->name }}</h5>
                            <p class="card-text">
                                {{ Str::limit($book->description, 100, '...') }} <!-- Hiển thị 100 ký tự đầu tiên của mô tả -->
                            </p>
                            <p class="card-text text-danger"><strong>Giá: {{ number_format($book->price, 0, ',', '.') }} VNĐ</strong></p>
                            <p class="card-text"><small class="text-muted">Số lượng: {{ $book->stock }}</small></p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">Xem chi tiết</a>
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center pagination">
        {{ $books->links() }} <!-- Phân trang -->
    </div>
</div>

<!-- Sử dụng CDN Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
