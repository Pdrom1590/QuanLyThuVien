<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('estimated_time')->nullable(); // Thêm cột estimated_time
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('estimated_time'); // Xóa cột nếu cần
    });
}
};