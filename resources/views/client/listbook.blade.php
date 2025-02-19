@extends('layouts.client')
@section('title', 'SÁCH CỦA THƯ VIỆN')
@section('listbooks')

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
</style>

<div class="container">
    <h1 class="mt-5 text-center">Danh sách Sản phẩm</h1>
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
    <form action="{{ route('books.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sách theo tên" required>
            <button class="btn btn-outline-secondary" type="submit">Tìm</button>
        </div>
    </form>

    <!-- Dropdown lọc -->
    <form action="{{ route('books.filter') }}" method="GET" class="mb-4">
        <select name="category" class="form-select" onchange="this.form.submit()">
            <option value="">Chọn thể loại</option>
            <option value="fiction">Tiểu thuyết</option>
            <option value="non-fiction">Phi hư cấu</option>
            <!-- Thêm các thể loại khác -->
        </select>
    </form>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img
                        src="{{ $product->image ? asset($product->image) : asset('images/default-image.jpg') }}"
                        class="card-img-top"
                        alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{ Str::limit($product->description, 100, '...') }} <!-- Hiển thị 100 ký tự đầu tiên của mô tả -->
                        </p>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#descriptionModal{{ $product->id }}">
                            Xem thêm
                        </button>
                        <p class="card-text text-danger"><strong>Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</strong></p>
                        <p class="card-text"><small class="text-muted">Số lượng: {{ $product->stock }}</small></p>

                        <!-- Nút xem chi tiết sản phẩm -->
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Xem chi tiết</a>

                        <!-- Form để thêm vào giỏ hàng -->
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal để hiển thị mô tả đầy đủ -->
            <div class="modal fade" id="descriptionModal{{ $product->id }}" tabindex="-1" aria-labelledby="descriptionModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="descriptionModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $product->description }}</p> <!-- Hiển thị mô tả đầy đủ -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>

<!-- Sử dụng CDN Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
