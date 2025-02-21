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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Thư Viện</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Trang Chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.list') }}">Đọc Sách</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">Đơn Hàng Của Tôi</a>
                            </li>
                        @endif
                    </ul>
                    <div class="ms-auto dropdown">
                        @if (Auth::check())
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Xem Hồ Sơ</a></li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng Xuất</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Đăng Nhập</a>
                        @endif
                    </div>
                    <!-- Giỏ hàng -->
                    <div class="ms-3 dropdown">
                        @guest
                        @else
                            <a class="nav-link dropdown-toggle" href="#" id="navbarCartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge bg-primary">{{ auth()->user()->carts()->count() }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarCartDropdown">
                                @if (auth()->user()->carts()->count() > 0)
                                    @foreach (auth()->user()->carts as $cart)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('books.show', $cart->book_id) }}">
                                                {{ $cart->book->name }} - Số lượng: {{ $cart->quantity }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('cart.show') }}">Xem Tất Cả</a>
                                    </li>
                                @else
                                    <li><span class="dropdown-item">Giỏ hàng trống.</span></li>
                                @endif
                            </ul>
                        @endguest
                    </div>
                    @if(Auth::check() && Auth::user()->role == "admin")
                        <div class="ms-3">
                            <a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
