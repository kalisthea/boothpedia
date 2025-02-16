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
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('eo_id');
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();

            // tenant_id FK
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');

            // eo_id FK
            $table->foreign('eo_id')->references('id')->on('users')->onDelete('cascade');

            // event_id FK
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
