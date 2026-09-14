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
        Schema::table('providers', function(Blueprint $table){
            $table->string('adress')->nullable();
            $table->string('town')->nullable();
            $table->string('pays')->nullable();
            $table->string('name_contact')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('providers', ['adress', 'town', 'pays', 'name_contact', 'note']);
    }
};