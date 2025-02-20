@include('layouts.header')
<div class="container py-3">
    @if(session('msg'))
    <div class="w-50 mx-auto">
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    </div>
    @endif
@yield('profile')
@yield('listbooks')
@yield('home')
@yield('login')
@yield('register')
@yield('content')
@yield('orders')
@yield('createOderblade')
</div>
@include('layouts.footer')
