<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('cashier_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('order_type');
            $table->string('order_status')->default('pending');
            $table->string('table_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('grand_total', 12, 2);
            $table->decimal('paid_amount', 12, 2);
            $table->decimal('change_amount', 12, 2);
            $table->string('payment_method');
            $table->string('transaction_status')->default('paid');
            $table->dateTime('transaction_date');
            $table->timestamps();
            $table->index(['order_status', 'transaction_date']);
            $table->index(['transaction_status', 'payment_method']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
