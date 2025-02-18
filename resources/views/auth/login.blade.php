@extends('layouts.client')
@section('content')
<div class="w-50 mx-auto">
<form action="" method="POST">
    <h1>Login</h1>
    @csrf
    {{-- <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div> --}}
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
@endsection
