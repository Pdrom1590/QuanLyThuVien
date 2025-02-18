<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container py-3">
    @if(session('msg'))
    <div class="w-50 mx-auto">
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    </div>
    @endif
@yield('content')
</div>
</body>
</html>
