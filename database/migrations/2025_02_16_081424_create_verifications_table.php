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
        Schema::create('verifications', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();  
            $table->unsignedBigInteger('id_num'); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('id_name');
            $table->string('id_address');
            $table->mediumText('id_photo')->charset('binary');
            $table->timestamps();

            // user_id FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
