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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone_name');
            $table->string('phone_image');
            $table->string('description');
            $table->integer('quantities');
            $table->integer('status');
            $table->integer('purchases');
            $table->integer('status');

            $table->unsignedBigInteger('manu_id'); // Mã hãng kiểu int
            $table->foreign('manu_id')->references('id')->on('manufacturers')->onDelete('cascade'); // Tạo khóa ngoại với bảng manufacturers

            $table->unsignedBigInteger('category_id'); // Mã hãng kiểu int
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Tạo khóa ngoại với bảng categories

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
