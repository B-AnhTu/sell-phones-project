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
        Schema::create('cartdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Mã hãng kiểu int
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Tạo khóa ngoại với bảng users

            $table->unsignedBigInteger('phone_id'); // Mã hãng kiểu int
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade'); // Tạo khóa ngoại với bảng phones
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartdetails');
    }
};
