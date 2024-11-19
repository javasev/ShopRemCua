<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); 
            $table->decimal('amount', 10, 2); 
            $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->enum('payment_method', ['COD', 'online'])->default('online'); 
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