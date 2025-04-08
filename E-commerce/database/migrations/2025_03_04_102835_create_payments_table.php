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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->enum('method', ['credit_card', 'paypal', 'cash_on_delivery'])->default('cash_on_delivery');
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->decimal('amount');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');
            $table->string('order_number');
            $table->foreign('order_number')->references('order_number')->on('orders')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
