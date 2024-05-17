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
            //$table->id();
            $table->increments('phone_id');            
            $table->string('phone_name', 100);
            $table->string('phone_image')->nullable();
            $table->text('description');
            $table->integer('quantities')->default(0);
            $table->double('price');
            $table->integer('status')->default(1);
            $table->integer('purchases')->default(0);
            $table->unsignedInteger('manu_id');
            $table->unsignedInteger('category_id');
            //Khóa ngoại
            $table->foreign('manu_id')->references('manu_id')->on('manufacturers')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');

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
