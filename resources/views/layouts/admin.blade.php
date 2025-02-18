<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('scss/main.scss')}}">
    <script src="{{asset('js/main.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-3">
            <h1>Menu</h1>
            <div>
                <!-- Hover added -->
    <div class="list-group" id="itemList">
    <a href="{{ route('products.list', ['active' => 'products']) }}" class="list-group-item list-group-item-action">Product</a>
    <a href="#" class="list-group-item list-group-item-action" onclick="setActive(this, 'user')">User</a>
    <a href="#" class="list-group-item list-group-item-action" onclick="setActive(this, 'paypal')">PayPal</a>
    <a href="#" class="list-group-item list-group-item-action" onclick="setActive(this, 'more')">More</a>
    <a class="list-group-item list-group-item-action" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
    </form>
    </div>
            </div>
        </div>
        <div class="col-9">
            @yield('content') <!-- Phần nội dung sẽ hiển thị ở đây -->
        </div>
    </div>
</div>
</body>
</html>
