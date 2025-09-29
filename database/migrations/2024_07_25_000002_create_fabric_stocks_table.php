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
        Schema::create('fabric_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fabric_id')->constrained('fabrics');
            $table->enum('transaction_type', ['in', 'out']);
            $table->decimal('qty', 8, 2);
            $table->string('barcode')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabric_stocks');
    }
};