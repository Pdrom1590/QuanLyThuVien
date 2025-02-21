@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Thống Kê Sách</h1>
    <div class="row">
        <div class="col-md-6">
            <h3>Tổng Số Sách</h3>
            <p>{{ $totalBooks }}</p>
        </div>
        <div class="col-md-6">
            <h3>Tổng Số Đơn Hàng</h3>
            <p>{{ $totalOrders }}</p>
        </div>
    </div>
    <h3>Danh Sách Sách Nổi Bật</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tên Sách</th>
                <th>Tác Giả</th>
                <th>Giá</th>
                <th>Tồn Kho</th>
            </tr>
        </thead>
        <tbody>
            @foreach($featuredBooks as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
