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
        Schema::create('fabrics', function (Blueprint $table) {
            $table->id();
            $table->string('fabric_no')->unique();
            $table->string('composition');
            $table->string('gsm');
            $table->decimal('qty', 8, 2);
            $table->string('cuttable_width');
            $table->enum('production_type', ['Sample Yardage', 'SMS', 'Bulk']);
            $table->string('construction')->nullable();
            $table->string('color_pantone_code')->nullable();
            $table->string('weave_type')->nullable();
            $table->string('finish_type')->nullable();
            $table->string('dyeing_method')->nullable();
            $table->string('printing_method')->nullable();
            $table->string('lead_time')->nullable();
            $table->string('moq')->nullable();
            $table->string('shrinkage')->nullable();
            $table->text('remarks')->nullable();
            $table->string('fabric_selected_by')->nullable();
            $table->string('image_path')->nullable();
            $table->string('barcode')->unique();
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('added_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabrics');
    }
};