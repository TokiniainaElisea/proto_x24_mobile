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
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->date('enter_date')->nullable();
            $table->integer('initial_quantity')->nullable();
            $table->integer('in_stock')->nullable();
            $table->double('provider_price')->nullable();
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
