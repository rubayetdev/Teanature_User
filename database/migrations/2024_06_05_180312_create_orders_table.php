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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_ip_address')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('order_status');
            $table->date('delivery_date')->nullable();
            $table->string('roles')->nullable();
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
