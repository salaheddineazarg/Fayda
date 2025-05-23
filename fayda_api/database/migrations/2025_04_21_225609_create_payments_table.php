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
            $table->decimal('amount',8,2);
            $table->enum('method', ['CASH', 'CREDIT_CARD', 'DIGITAL_WALLET'])->default('CASH');
            $table->enum('status', ['PENDING', 'REJECTED', 'ACCEPTED'])->default('PENDING');
            $table->string('transaction_id')->nullable();

            $table->foreignId('order_id')
            ->constrained('orders')
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
