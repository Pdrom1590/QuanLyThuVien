@extends('layouts.client')

@section('content')
    <h1 class="mt-5">Chào Mừng Đến Với Hệ Thống Quản Lý Thư Viện</h1>
    <p>Khám phá hàng triệu cuốn sách và quản lý đơn hàng của bạn một cách dễ dàng.</p>
    <a href="{{ route('books.list') }}" class="btn btn-primary">Xem Sách</a>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
