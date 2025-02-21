@extends('layouts.client')

@section('content')

    <h1 class="mt-5">Giỏ Hàng</h1>

    @if($carts->isEmpty())
        <p>Giỏ hàng của bạn đang trống.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Sách</th>
                    <th>Giá</th>
                    <th>Ngày Hẹn Lấy</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{ $cart->book->name }}</td>
                        <td>{{ number_format($cart->book->price, 0, ',', '.') }} VNĐ</td>
                        <td>
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $cart->book->id }}">
                                <input type="date" name="pickup_date" class="form-control" required>
                                <button type="submit" class="btn btn-success mt-2">Đặt Hàng</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.delete', $cart->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
