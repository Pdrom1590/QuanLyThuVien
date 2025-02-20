<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Tùy chọn này định nghĩa "guard" xác thực mặc định và "broker" đặt lại mật khẩu
    | cho ứng dụng của bạn. Bạn có thể thay đổi các giá trị này
    | theo yêu cầu, nhưng chúng là một khởi đầu hoàn hảo cho hầu hết các ứng dụng.
    |
    */

    'defaults' => [
        'guard' => 'web', // Đặt guard mặc định là 'web'
        'passwords' => 'users', // Đặt broker mật khẩu mặc định là 'users'
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Tiếp theo, bạn có thể định nghĩa mọi guard xác thực cho ứng dụng của bạn.
    | Tất nhiên, một cấu hình mặc định tuyệt vời đã được định nghĩa cho bạn
    | sử dụng lưu trữ phiên cùng với nhà cung cấp người dùng Eloquent.
    |
    | Hỗ trợ: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Tất cả các guard xác thực đều có một nhà cung cấp người dùng, định nghĩa cách mà
    | người dùng thực sự được truy xuất từ cơ sở dữ liệu hoặc hệ thống lưu trữ khác
    | được ứng dụng sử dụng. Thông thường, Eloquent được sử dụng.
    |
    | Hỗ trợ: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Tham chiếu trực tiếp đến mô hình User
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Các tùy chọn cấu hình này xác định hành vi của chức năng đặt lại mật khẩu của Laravel,
    | bao gồm bảng được sử dụng để lưu trữ token và nhà cung cấp người dùng được gọi
    | để thực sự truy xuất người dùng.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens', // Sử dụng tên bảng mặc định
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Tại đây bạn có thể định nghĩa số giây trước khi cửa sổ xác nhận mật khẩu
    | hết hạn và người dùng được yêu cầu nhập lại mật khẩu của họ qua màn hình
    | xác nhận. Theo mặc định, thời gian chờ kéo dài trong ba giờ.
    |
    */

    'password_timeout' => 10800, // Thời gian chờ mặc định
];