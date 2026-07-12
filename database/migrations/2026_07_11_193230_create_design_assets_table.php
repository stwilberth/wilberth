<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('type');
            $table->json('position')->nullable();
            $table->json('size')->nullable();
            $table->integer('rotation')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_assets');
    }
};