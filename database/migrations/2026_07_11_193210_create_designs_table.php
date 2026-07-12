<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_cut')->default('Normal');
            $table->string('sleeve_style')->default('Corta');
            $table->string('material')->default('Algodón');
            $table->string('color')->default('#000000');
            $table->json('layers')->nullable();
            $table->string('view_side')->default('front');
            $table->decimal('price_estimate', 10, 2)->default(0);
            $table->string('exported_png_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};