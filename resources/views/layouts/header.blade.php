<!-- resources/views/layouts/header.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="{{ route('home') }}" aria-current="page">Home <span class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href="{{ route('books') }}">Đọc sách của thư viện</a>
                <div class="ml-auto dropdown">
                    @if (Auth::check())
                        <a class="nav-link dropdown-toggle" href="{{ route('profile') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle cover" style="width: 30px; height: 30px;   object-fit: cover;">
                            @else
                                <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                            @endif
                            {{ Auth::user()->name }} <!-- Hiển thị tên người dùng -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Xem hồ sơ</a></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </div>
<!-- Giỏ hàng -->
<div class="ml-auto dropdown">
    @guest
        <span class="nav-link">You need to log in to view your cart.</span>
    @else
        <a class="nav-link dropdown-toggle" href="#" id="navbarCartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-shopping-cart"></i> <!-- Biểu tượng giỏ hàng -->
            <span class="badge bg-primary">{{ auth()->user()->carts()->count() }}</span> <!-- Hiển thị số lượng sản phẩm -->
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarCartDropdown">
            @if (auth()->user()->carts()->count() > 0)
                @foreach (auth()->user()->carts as $cart)
                    <li>
                        <a class="dropdown-item" href="{{ route('products.show', $cart->product_id) }}">
                            {{ $cart->product->name }} - Số lượng: {{ $cart->quantity }}
                        </a>
                    </li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('cart.show') }}">Xem tất cả</a>
                </li>
            @else
                <li><span class="dropdown-item">Giỏ hàng trống.</span></li>
            @endif
        </ul>
    @endguest
</div>
</div>
        </nav>
    </div>
</body>
</html>
