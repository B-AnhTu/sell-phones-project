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
            //$table->id();
            $table->increments('cartdetail_id');
            $table->integer('user_id');
            $table->integer('phone_id'); //Mã phone 
            $table->integer('quantities');
            
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
