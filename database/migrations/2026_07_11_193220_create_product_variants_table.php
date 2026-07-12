<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('cut');
            $table->string('sleeve_style');
            $table->string('material');
            $table->decimal('base_price', 10, 2);
            $table->timestamps();
            
            $table->unique(['cut', 'sleeve_style', 'material']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};