<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id'); // ID của sách
            $table->integer('quantity');
            $table->date('pickup_date');
            $table->date('return_date')->nullable(); // Ngày trả
            $table->string('status')->default('pending'); // Trạng thái đơn hàng
            $table->date('due_date')->nullable(); // Ngày đến hạn
            $table->unsignedBigInteger('user_id'); // ID của người dùng
            $table->unsignedBigInteger('borrower_id')->nullable(); // ID của người mượn
            $table->unsignedBigInteger('staff_id')->nullable(); // ID của nhân viên
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('borrower_id')->references('id')->on('users')->onDelete('set null'); // Khóa ngoại cho người mượn
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null'); // Khóa ngoại cho nhân viên
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}