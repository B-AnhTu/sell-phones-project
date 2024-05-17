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
        Schema::create('cart_phones', function (Blueprint $table) {
            //$table->id();
            $table->increments('cart_phone_id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('phone_id');
            $table->integer('quantity');
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->foreign('phone_id')->references('phone_id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_phones');
    }
};
