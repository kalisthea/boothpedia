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
        Schema::create('refunds', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('eo_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('invoice_id');
            $table->text('reason');
            $table->text('additional');
            $table->mediumText('image')->charset('binary')->nullable();
            $table->text('bank');
            $table->text('bank_number');
            $table->text('account_name');
            $table->string('status', 50)->nullable();
            $table->timestamps();

            // tenant_id FK
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');

            // eo_id FK
            $table->foreign('eo_id')->references('id')->on('users')->onDelete('cascade');

            // invoice_id FK
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            // event_id FK
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
