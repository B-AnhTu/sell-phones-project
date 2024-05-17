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
        Schema::create('profiles', function (Blueprint $table) {
            //$table->id();
            $table->increments('profile_id');
            $table->unsignedBigInteger('user_id');
            $table->string('address');
            $table->string('phone_number');
            $table->string('image')->nullable();
            $table->string('gender');
            $table->date('date_of_birth');
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
