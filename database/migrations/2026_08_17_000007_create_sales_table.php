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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->string('status');
            $table->double('discount')->nullable();
            $table->double('total_price');
            $table->string('note')->nullable();
            $table->string('payment_method')->nullable();;
            $table->string('sale_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
