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
        Schema::create('invoicebooths', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('booth_id');

            // invoice_id FK
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            // booth_id FK
            $table->foreign('booth_id')->references('id')->on('booths')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicebooths');
    }
};
