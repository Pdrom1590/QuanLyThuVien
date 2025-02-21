<!-- resources/views/layouts/staff.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Thay đổi đường dẫn nếu cần -->
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('staff.dashboard') }}">Staff Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.books.index') }}">Quản Lý Sách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.orders.index') }}">Quản Lý Đơn Hàng</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Đăng Xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="mt-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
