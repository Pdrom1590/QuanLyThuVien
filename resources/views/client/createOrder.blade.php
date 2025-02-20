@extends('layouts.client')

@section('createOderblade')
<div class="container">
    <h1>Place an Order</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Available: {{ $product->stock }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="pickup_date">Pickup Date</label>
            <input type="date" name="pickup_date" id="pickup_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
