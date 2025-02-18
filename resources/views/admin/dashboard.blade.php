@extends('layouts.admin') <!-- Trỏ đến layout đúng -->

@section('title', 'Dashboard') <!-- Đặt tiêu đề cho trang -->

@section('content') <!-- Đoạn nội dung chính -->
<h1>Dashboard</h1>
@yield('listprd')
@yield('createprd')
@endsection
