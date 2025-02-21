@extends('layouts.staff')

@section('content')
 @vite(['resources/scss/app.scss', 'resources/js/app.js']) <!-- Nếu bạn sử dụng Vite cho CSS và JS -->

    <h1 class="mt-5">Chào mừng đến với Dashboard của Staff</h1>
    <p>Ở đây bạn có thể quản lý sách và đơn hàng.</p>
@endsection
