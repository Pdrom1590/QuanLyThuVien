<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Home <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="{{ route('home') }}">Home</a>
            @if (!Auth::check())
                <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
            @else
            <a class="nav-item nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
        </div>
    </nav>
</div>
</body>
</html>
