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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('order_number')->unique();
            $table->text('shipping_address');
            $table->string('shipping_city', 100);
            $table->string('shipping_postal_code', 20);
            $table->string('shipping_country', 100);
            $table->string('shipping_phone', 20);
            $table->string('shipping_email', 150);
            $table->string('shipping_name', 60);
            $table->enum('payment_method', ['credit_card', 'paypal', 'cash_on_delivery'])->default('cash_on_delivery');
            $table->decimal('total_amount');
            $table->enum('status', ['pending', 'in shipping', 'completed', 'cancelled'])->default('pending');
            $table->text('cancellation_reason')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
