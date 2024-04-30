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
        Schema::create('preniums', function (Blueprint $table) {
            //$table->id();
            $table->increments('prenium_id');
            $table->integer('user_id');
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->text('address');
            $table->string('phone');
            $table->string('favorite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preniums');
    }
};
