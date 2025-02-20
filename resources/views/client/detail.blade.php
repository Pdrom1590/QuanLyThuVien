@extends('layouts.client')
@section('title', $product->name)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p><strong>Giá: </strong>{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
            <p><strong>Số lượng: </strong>{{ $product->stock }}</p>
            <p><strong>Mô tả: </strong>{{ $product->description }}</p>

            <!-- Form thêm vào giỏ hàng -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>

    <!-- Nút quay lại danh sách sản phẩm -->
    <div class="mt-3">
        <a href="{{ route('products.list') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
