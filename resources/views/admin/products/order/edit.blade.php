@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order</h1>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Order Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection
