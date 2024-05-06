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
            $table->string('description', 100);
            $table->integer('quantities')->default(0);
            $table->double('price');
            $table->integer('status');
            $table->integer('purchases')->default(0);
            $table->integer('manu_id');
            $table->integer('category_id');

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
