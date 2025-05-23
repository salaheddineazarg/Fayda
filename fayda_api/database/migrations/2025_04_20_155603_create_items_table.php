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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->timestamp('from_date')->nullable();
            $table->timestamp('to_date')->nullable(); 
            $table->enum('status', ['AVAILABLE', 'UNAVAILABLE'])->default('AVAILABLE');
            $table->unsignedInteger('quantity')->default(1);
            $table->enum('category', ['SECRET_BAG', 'NORMAL'])->default('NORMAL');
            
            $table->foreignId('store_id')
                  ->constrained('stores')
                  ->onDelete('cascade'); 
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
