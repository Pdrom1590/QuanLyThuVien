@extends('layouts.client')

@section('content')
    <h1 class="mt-5">Danh Sách Đơn Hàng</h1>

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Đơn Hàng</th>
                    <th>Tên Sách</th>
                    <th>Ngày Đặt</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Hẹn Lấy</th>
                    <th>Thời Hạn Phải Trả</th>
                    <th>Ngày Đã Trả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->book->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->pickup_date ? \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') : 'Chưa xác định' }}</td>
                        <td>{{ $order->due_date ? \Carbon\Carbon::parse($order->due_date)->format('d/m/Y') : 'Chưa xác định' }}</td>
                        <td>{{ $order->return_date ? \Carbon\Carbon::parse($order->return_date)->format('d/m/Y') : 'Chưa xác định' }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                                </form>
                            @elseif($order->status === 'borrowed')
                                <span class="text-muted">Không thể hủy (đang mượn)</span>
                            @elseif($order->status === 'returned')
                                <span class="text-muted">Đơn hàng đã được trả</span>
                            @else
                                <span class="text-muted">Không thể hủy</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $orders->links() }} <!-- Phân trang -->
@endsection
