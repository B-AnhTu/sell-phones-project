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
        Schema::create('cart_details', function (Blueprint $table) {
            //$table->id();
            $table->increments('cart_detail_id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('phone_id'); //Mã phone 
            $table->integer('quantities');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->foreign('phone_id')->references('phone_id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
