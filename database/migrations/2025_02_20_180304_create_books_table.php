<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->string('isbn')->unique();
            $table->date('published_date')->nullable();
            $table->string('status')->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}