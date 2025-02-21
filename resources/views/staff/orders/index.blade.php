@extends('layouts.staff')

@section('content')
    @vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->
    <h1 class="mt-5">Danh Sách Sách Đã Mượn</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p>Không có đơn hàng nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Đơn Hàng</th>
                    <th>Tên Sách</th>
                    <th>Người Đặt</th>
                    <th>Ngày Đặt</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->book->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <form action="{{ route('staff.orders.confirm', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Xác Nhận</button>
                                </form>
                            @else
                                <span class="text-muted">Đã xác nhận</span>
                            @endif

                            <!-- Dropdown để thay đổi trạng thái -->
                            <form action="{{ route('staff.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="{{ App\Models\Order::STATUS_BORROWED }}" {{ $order->status === App\Models\Order::STATUS_BORROWED ? 'selected' : '' }}>Đã Mượn</option>
                                    <option value="{{ App\Models\Order::STATUS_RETURNED }}" {{ $order->status === App\Models\Order::STATUS_RETURNED ? 'selected' : '' }}>Đã Trả</option>
                                    <option value="{{ App\Models\Order::STATUS_OVERDUE }}" {{ $order->status === App\Models\Order::STATUS_OVERDUE ? 'selected' : '' }}>Đã Quá Hạn</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ $orders->links() }} <!-- Phân trang -->
@endsection
