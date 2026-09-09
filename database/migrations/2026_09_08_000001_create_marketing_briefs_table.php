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
        Schema::create('marketing_briefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marketing_brief_link_id')->nullable()->constrained('marketing_brief_links')->onDelete('set null');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('offer')->comment('¿Qué vendes o qué servicio ofreces?');
            $table->string('target_audience')->comment('¿Qué tipo de personas son tus principales clientes?');
            $table->string('differentiator')->comment('¿Por qué tus clientes te eligen a ti y no a otro negocio?');
            $table->string('main_goal')->comment('¿Qué es lo que más te interesa conseguir con la página?');
            $table->text('first_impression')->comment('¿Qué es lo primero que te gustaría que una persona entendiera al entrar a tu página?');
            $table->string('promoted_service')->comment('¿Hay algún producto o servicio que te interese promocionar especialmente?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_briefs');
    }
};
