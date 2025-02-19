@extends('admin.dashboard')

@section('content')
    <h1>Shopping Cart</h1>

    @if($cart)
        <ul>
            @foreach ($cart->items as $item)
                <li>{{ $item->name }} - {{ $item->price }}</li>
            @endforeach
        </ul>
    @else
        <p>This user has an empty cart.</p>
    @endif
@endsection
