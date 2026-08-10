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
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('business_type');
            $table->text('business_description');
            $table->string('location')->nullable();
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->json('pages_needed');
            $table->text('extra_features')->nullable();
            $table->json('content_available');
            $table->string('brand_colors')->nullable();
            $table->text('website_examples')->nullable();
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            $table->text('competitors')->nullable();
            $table->text('special_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('briefs');
    }
};
