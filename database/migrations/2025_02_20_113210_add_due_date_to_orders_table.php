<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->date('due_date')->nullable(); // Thêm cột due_date
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('due_date'); // Xóa cột nếu cần
    });
}
};