@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tất Cả Đơn Hàng</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Ngày Nhận</th>
                <th>Trạng Thái</th>
                <th>Tên Người Đặt</th>
                <th>Tên Người Mượn</th>
                <th>Thời Gian Mượn</th>
                <th>Thời Gian Phải Trả</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->pickup_date }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->user ? $order->user->name : 'Người dùng không xác định' }}</td>
                    <td>{{ $order->borrowed_by ? \App\Models\User::find($order->borrowed_by)->name : 'Chưa mượn' }}</td>
                    <td>{{ $order->borrowed_at ? $order->borrowed_at->format('d/m/Y H:i') : 'Chưa mượn' }}</td>
                    <td>{{ $order->due_date ? $order->due_date->format('d/m/Y') : 'Chưa có thời gian phải trả' }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang Chờ</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn Thành</option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã Hủy</option>
                                <option value="borrowing" {{ $order->status == 'borrowing' ? 'selected' : '' }}>Đang Mượn</option> <!-- Thêm trạng thái đang mượn -->
                            </select>
                        </form>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
