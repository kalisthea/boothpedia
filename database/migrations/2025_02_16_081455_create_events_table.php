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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();  
            $table->unsignedBigInteger('user_id'); 
            $table->string('name');
            $table->text('description'); 
            $table->string('category', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->string('venue'); 
            $table->mediumText('banner_photo')->charset('binary')->nullable();
            $table->mediumText('proposal_doc')->charset('binary')->nullable();
            $table->mediumText('layout_photo')->charset('binary')->nullable();
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
        Schema::dropIfExists('events');
    }
};
