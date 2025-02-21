@extends('layouts.admin') <!-- Trỏ đến layout đúng -->

@section('title', 'Dashboard') <!-- Đặt tiêu đề cho trang -->

@section('content') <!-- Đoạn nội dung chính -->
<h1 class="mt-4">Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Tổng Số Sách</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totalBooks }}</h5>
                <p class="card-text">Số lượng sách hiện có trong hệ thống.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Tổng Số Đơn Hàng</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totalOrders }}</h5>
                <p class="card-text">Số lượng đơn hàng đã được thực hiện.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Sách Mới Nhất</div>
            <div class="card-body">
                <h5 class="card-title">5 Sách Mới Nhất</h5>
                <ul>
                    @foreach($featuredBooks as $book)
                        <li>{{ $book->name }} ({{ $book->author }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h2>Quản Lý Sách</h2>
    <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary">Thêm Sách Mới</a>
    <a href="{{ route('dashboard.books.index') }}" class="btn btn-secondary">Xem Danh Sách Sách</a>
</div>

<div class="mt-4">
    <h2>Quản Lý Đơn Hàng</h2>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Xem Danh Sách Đơn Hàng</a>
</div>

@endsection
