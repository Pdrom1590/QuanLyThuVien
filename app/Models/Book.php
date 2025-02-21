<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'price',
        'stock',
        'description',
        'image',
        'isbn',
        'published_date',
    ];

    // Định nghĩa mối quan hệ với model Order (nếu cần)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}