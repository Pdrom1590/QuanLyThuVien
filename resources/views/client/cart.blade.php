@extends('layouts.client')

@section('content')
<div class="container">
    <h1 class="mb-4">Giỏ hàng</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($carts->isEmpty())
        <p>Giỏ hàng của bạn đang trống.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Thời gian thêm vào giỏ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ $cart->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('cart.delete', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Nút Đặt hàng -->
        <div class="mt-3">
            <h3>Đặt hàng</h3>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">Sản phẩm</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach ($carts as $cart)
                            <option value="{{ $cart->product->id }}">{{ $cart->product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickup_date">Ngày nhận hàng</label>
                    <input type="date" name="pickup_date" id="pickup_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Đặt hàng</button>
            </form>
        </div>
    @endif

    <div class="mt-3">
        <h3>Thêm sản phẩm vào giỏ hàng</h3>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Sản phẩm</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->stock }} còn lại)</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
        </form>
    </div>
</div>
@endsection
