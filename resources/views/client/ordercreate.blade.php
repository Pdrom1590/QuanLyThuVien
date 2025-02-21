@extends('layouts.client')

@section('content')
    <h1 class="mt-5">Đặt Hàng: {{ $book->name }}</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <div class="form-group">
            <label for="pickup_date">Ngày Hẹn Lấy</label>
            <input type="date" class="form-control @error('pickup_date') is-invalid @enderror" id="pickup_date" name="pickup_date" required>
            @error('pickup_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Đặt Hàng</button>
        <a href="{{ route('books.list') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
