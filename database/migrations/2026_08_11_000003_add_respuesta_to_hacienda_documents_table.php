<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hacienda_documents', function (Blueprint $table) {
            $table->string('respuesta_estado')->nullable()->after('total');
            $table->string('respuesta_fecha')->nullable()->after('respuesta_estado');
            $table->json('respuesta_mensajes')->nullable()->after('respuesta_fecha');
            $table->longText('respuesta_xml')->nullable()->after('respuesta_mensajes');
        });
    }

    public function down(): void
    {
        Schema::table('hacienda_documents', function (Blueprint $table) {
            $table->dropColumn(['respuesta_estado', 'respuesta_fecha', 'respuesta_mensajes', 'respuesta_xml']);
        });
    }
};
