@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Danh Sách Đơn Hàng</h1>

    @if($orders->isEmpty())
        <p>Không có đơn hàng nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Đơn Hàng</th>
                    <th>Tên Sách</th>
                    <th>Ngày Đặt</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Hẹn Lấy</th>
                    <th>Ngày Trả</th>
                    <th>Người Mượn</th>
                    <th>Nhân Viên</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->book->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="borrowed" {{ $order->status === 'borrowed' ? 'selected' : '' }}>Đã mượn</option>
                                    <option value="returned" {{ $order->status === 'returned' ? 'selected' : '' }}>Đã trả</option>
                                    <option value="overdue" {{ $order->status === 'overdue' ? 'selected' : '' }}>Quá hạn</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $order->pickup_date ? \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') : 'Chưa xác định' }}</td>
                        <td>{{ $order->return_date ? \Carbon\Carbon::parse($order->return_date)->format('d/m/Y') : 'Chưa xác định' }}</td>
                        <td>{{ $order->borrower ? $order->borrower->name : 'Chưa xác định' }}</td>
                        <td>{{ $order->staff ? $order->staff->name : 'Chưa xác định' }}</td>
                        <td>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $orders->links() }} <!-- Phân trang -->
@endsection
