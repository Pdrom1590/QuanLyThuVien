@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>
    <p><strong>Tên Sách:</strong> {{ $order->book->name }}</p>
    <p><strong>Người Đặt:</strong> {{ $order->user->name }}</p>
    <p><strong>Ngày Đặt:</strong> {{ $order->created_at }}</p>
    <p><strong>Trạng Thái:</strong> {{ $order->status }}</p>
    <p><strong>Ngày Hết Hạn:</strong> {{ $order->due_date }}</p>
    <p><strong>Ngày Mượn:</strong> {{ $order->borrowed_at }}</p>
    <p><strong>Người Mượn:</strong> {{ $order->borrowed_by ? $order->borrowedBy->name : 'Chưa mượn' }}</p>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay Lại</a>
@endsection
