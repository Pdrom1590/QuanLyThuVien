<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'pickup_date',
        'status',
        'estimated_time',
        'user_id',
        'due_date'
    ];

    // Định nghĩa mối quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Sử dụng user_id để liên kết với bảng users
    }

    // Định nghĩa mối quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
        public function getDueDateAttribute($value)
    {
        return Carbon::parse($value); // Chuyển đổi chuỗi thành đối tượng Carbon
    }
}