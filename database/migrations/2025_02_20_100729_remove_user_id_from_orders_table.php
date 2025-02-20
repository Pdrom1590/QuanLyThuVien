<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa khóa ngoại nếu có
            $table->dropColumn('user_id'); // Xóa cột user_id
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id'); // Thêm lại cột user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Khôi phục khóa ngoại
        });
    }
};