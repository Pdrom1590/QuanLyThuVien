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
        $table->text('description')->nullable(); // Tạo cột mô tả, có thể null
        $table->string('image')->nullable(); // Tạo cột cho hình ảnh
        $table->string('category')->nullable(); // Tạo cột cho thể loại sản phẩm
        $table->string('sku')->unique()->nullable(); // Tạo cột SKU, có thể null và phải là duy nhất
        $table->string('status')->default('active'); // Tạo cột trạng thái, mặc định là 'active'
        $table->decimal('rating', 2, 1)->default(0); // Tạo cột đánh giá, mặc định là 0
        $table->unsignedBigInteger('created_by')->nullable(); // Tạo cột cho người tạo
        $table->unsignedBigInteger('updated_by')->nullable(); // Tạo cột cho người cập nhật
        $table->timestamps(); // Tạo cột created_at và updated_at
        // Nếu bạn có bảng users, bạn có thể thêm khóa ngoại
        $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
    });
    //nếu bạn cài lại file thì nhớ xóa cái file update
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};