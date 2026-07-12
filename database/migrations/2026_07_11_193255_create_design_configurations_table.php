<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('product_type')->default('t-shirt');
            $table->json('canvas')->nullable();
            $table->json('layers')->nullable();
            $table->json('selected_variants')->nullable();
            $table->json('preview_image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_configurations');
    }
};