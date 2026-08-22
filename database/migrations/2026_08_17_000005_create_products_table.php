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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product');
            $table->string('reference')->nullable();
            $table->double('price')->nullable();
            $table->foreignId('provider_id')
                ->nullable()
                ->constrained('providers')
                ->cascadeOnDelete();
            $table->string('image_path')->nullable();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete();
            $table->foreignId('detail_id')
                ->nullable()
                ->constrained('details')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
