<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->unsignedBigInteger('borrowed_by')->nullable(); // ID của người mượn
        $table->timestamp('borrowed_at')->nullable(); // Thời gian mượn
        $table->timestamp('due_date')->nullable(); // Thời gian phải trả
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['borrowed_by', 'borrowed_at', 'due_date']);
    });
}
};