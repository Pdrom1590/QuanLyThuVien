@include('layouts.header')

<div class="container py-3">
    @if(session('msg'))
        <div class="w-50 mx-auto">
            <div class="alert alert-danger">
                {{ session('msg') }}
            </div>
        </div>
    @endif

    @yield('content') <!-- Chỉ sử dụng một yield cho nội dung chính -->
</div>

@include('layouts.footer')
