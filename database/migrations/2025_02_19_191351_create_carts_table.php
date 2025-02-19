<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự động tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable(); // Khóa ngoại đến bảng users
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến bảng products
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};