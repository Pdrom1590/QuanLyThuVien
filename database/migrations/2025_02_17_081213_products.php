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
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Tạo cột id tự động tăng
        $table->string('name'); // Tạo cột tên sản phẩm
        $table->decimal('price', 10, 2); // Thay 'number' bằng 'decimal' để lưu giá
        $table->integer('stock'); // Tạo cột số lượng
        $table->text('description'); // Tạo cột mô tả
        $table->string('image')->nullable(); // Tạo cột cho hình ảnh
        $table->timestamps(); // Tạo cột created_at và updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};