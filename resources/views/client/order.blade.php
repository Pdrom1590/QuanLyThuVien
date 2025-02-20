@extends('layouts.client')

@section('content')
<div class="container">
    <h1>Your Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Pickup Date</th>
                <th>Status</th>
                <th>Due Date</th> <!-- Thêm cột thời hạn phải trả -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->pickup_date }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
<td>
    @if($order->due_date) <!-- Kiểm tra xem due_date có phải là null không -->
        {{ $order->due_date->format('d/m/Y') }} <!-- Hiển thị thời hạn phải trả -->
        @if($order->due_date->diffInDays(now()) <= 5 && $order->status === 'pending') <!-- Kiểm tra nếu còn 5 ngày -->
            <span class="text-warning">Cần phải trả trước {{ $order->due_date->diffInDays(now()) }} ngày!</span>
        @endif
    @else
        <span class="text-muted">Chưa có thời hạn phải trả</span> <!-- Thông báo nếu không có thời hạn -->
    @endif
</td>
                    <td>
                        @if($order->status === 'pending') <!-- Chỉ hiển thị nút hủy nếu đơn hàng đang chờ -->
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
