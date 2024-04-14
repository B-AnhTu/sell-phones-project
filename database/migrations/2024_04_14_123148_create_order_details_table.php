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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Mã đơn hàng kiểu int
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Tạo khóa ngoại với bảng orders
            $table->unsignedBigInteger('phone_id'); // Mã hãng kiểu int
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade'); // Tạo khóa ngoại với bảng phones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
