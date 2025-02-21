@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Thanh Toán Đơn Hàng</h1>
    <form action="{{ route('orders.payment.process', $order->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Phương Thức Thanh Toán</label>
            <select name="payment_method" class="form-control" required>
                <option value="credit_card">Thẻ Tín Dụng</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="card_number" class="form-label">Số Thẻ</label>
            <input type="text" name="card_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày Hết Hạn (mm/yy)</label>
            <input type="text" name="expiry_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" name="cvv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Xác Nhận Thanh Toán</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
@endsection
