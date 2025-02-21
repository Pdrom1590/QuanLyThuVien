@extends('layouts.client')

@section('title', $book->name)

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1 class="mt-5">{{ $book->name }}</h1>
        <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-image.jpg') }}" alt="{{ $book->name }}" class="img-fluid mb-3">
        <p><strong>Tác Giả:</strong> {{ $book->author }}</p>
        <p><strong>Giá:</strong> {{ number_format($book->price, 0, ',', '.') }} VNĐ</p>
        <p><strong>Tồn Kho:</strong> {{ $book->stock }}</p>
        <p><strong>Thể Loại:</strong> {{ $book->category }}</p>
        <p><strong>Ngày Xuất Bản:</strong> {{ \Carbon\Carbon::parse($book->published_date)->format('d/m/Y') }}</p>
        <p><strong>Mô Tả:</strong> {{ $book->description }}</p>
        <p><strong>Trạng Thái:</strong> {{ $book->status }}</p>
        <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <button type="submit" class="btn btn-success">Thêm vào Giỏ Hàng</button>
    </form>
        <a href="{{ route('books.list') }}" class="btn btn-secondary">Quay Lại Danh Sách</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
