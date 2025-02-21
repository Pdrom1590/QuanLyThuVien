@extends('layouts.client')

@section('title', $book->name)

@section('content')
@vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->

<div class="container py-5">
    <div class="row">
        <!-- Nút quay lại -->
        <div class="col-12 mb-4">
            <a href="{{ route('books.list') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
            </a>
        </div>

        <!-- Phần chính -->
        <div class="col-lg-5 mb-4">
            <div class="book-image-container shadow-lg">
                <img src="{{ $book->image }}" alt="{{ $book->name }}" class="img-fluid rounded-3">
            </div>
        </div>

        <div class="col-lg-7">
            <h1 class="display-4 mb-3 fw-bold text-primary">{{ $book->name }}</h1>

            <div class="d-flex align-items-center gap-2 mb-4">
                <span class="badge bg-success fs-6">{{ $book->category }}</span>
                <span class="badge bg-info fs-6">Tồn kho: {{ $book->stock }}</span>
            </div>

            <div class="bg-light p-4 rounded-3 shadow-sm mb-4">
                <h3 class="text-danger fw-bold mb-4">${{ number_format($book->price, 2) }}</h3>

                <dl class="row mb-0">
                    <dt class="col-sm-3">Tác giả:</dt>
                    <dd class="col-sm-9 fs-5">{{ $book->author }}</dd>

                    <dt class="col-sm-3">Ngày xuất bản:</dt>
                    <dd class="col-sm-9 fs-5">{{ date('d/m/Y', strtotime($book->published_date)) }}</dd>

                    <dt class="col-sm-3">Trạng thái:</dt>
                    <dd class="col-sm-9">
                        <span class="badge {{ $book->status ? 'bg-success' : 'bg-secondary' }} fs-6">
                            {{ $book->status ? 'Có sẵn' : 'Hết hàng' }}
                        </span>
                    </dd>
                </dl>
            </div>

            <div class="mb-4">
                <h4 class="mb-3">Mô tả sách</h4>
                <p class="lead text-muted lh-lg">{{ $book->description }}</p>
            </div>

            <div class="d-flex gap-3">
                <button class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                </button>
                <button class="btn btn-outline-danger btn-lg px-5">
                    <i class="fas fa-heart"></i> Yêu thích
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .book-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .book-image-container:hover {
        transform: translateY(-5px);
    }

    .book-image-container img {
        transition: transform 0.3s ease;
    }

    .book-image-container:hover img {
        transform: scale(1.05);
    }

    dt {
        font-weight: 500;
        color: #6c757d;
    }

    dd {
        font-weight: 400;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
@endsection
