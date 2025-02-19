@extends('layouts.client')
@section('title', 'TRANG CHỦ')
@section('home')
    <header class="hero">
        <div class="container">
            <h1 class="display-4">Quản Lý Thư Viện</h1>
            <p class="lead">Nơi lưu giữ tri thức và văn hóa</p>
        </div>
    </header>

    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center">Giới Thiệu</h2>
            <p class="text-center">Hệ thống quản lý thư viện giúp bạn dễ dàng quản lý sách, độc giả và các hoạt động liên quan đến thư viện. Với giao diện thân thiện và dễ sử dụng, bạn có thể tìm kiếm, mượn, trả sách một cách nhanh chóng và hiệu quả.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="text-center">Tính Năng Nổi Bật</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                    <h3>Quản Lý Sách</h3>
                    <p>Thêm, sửa, xóa thông tin sách một cách dễ dàng. Hệ thống hỗ trợ nhiều thể loại sách khác nhau.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h3>Quản Lý Độc Giả</h3>
                    <p>Quản lý thông tin độc giả và lịch sử mượn sách. Theo dõi tình trạng mượn trả sách của từng độc giả.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h3>Tìm Kiếm Nhanh</h3>
                    <p>Tìm kiếm sách theo tên, tác giả hoặc thể loại chỉ trong vài giây. Giúp bạn tiết kiệm thời gian và công sức.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center">Lợi Ích Khi Sử Dụng Hệ Thống</h2>
            <ul class="list-group">
                <li class="list-group-item">Tiết kiệm thời gian trong việc quản lý sách và độc giả.</li>
                <li class="list-group-item">Dễ dàng theo dõi tình trạng sách và lịch sử mượn trả.</li>
                <li class="list-group-item">Giao diện thân thiện, dễ sử dụng cho mọi đối tượng.</li>
                <li class="list-group-item">Hỗ trợ nhiều tính năng nâng cao như thống kê và báo cáo.</li>
            </ul>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
