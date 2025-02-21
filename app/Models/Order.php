<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'quantity',
        'pickup_date',
        'status',
        'due_date',
        'return_date', // Thêm trường return_date
        'user_id',
        'borrowed_by', // Nếu bạn cần lưu thông tin người mượn
        'borrowed_at', // Nếu bạn cần lưu thời gian mượn
    ];

    const STATUS_PENDING = 'pending'; // Chờ xử lý
    const STATUS_BORROWED = 'borrowed'; // Đang mượn
    const STATUS_RETURNED = 'returned'; // Đã trả
    const STATUS_OVERDUE = 'overdue'; // Quá hạn

    // Định nghĩa mối quan hệ với model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Định nghĩa mối quan hệ với model User (người mượn)
    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrowed_by'); // Sử dụng borrowed_by để liên kết với người mượn
    }

    // Định nghĩa mối quan hệ với model User (nhân viên)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id'); // Đảm bảo rằng staff_id là tên cột trong bảng orders
    }

    // Định nghĩa mối quan hệ với model User (người đặt hàng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}