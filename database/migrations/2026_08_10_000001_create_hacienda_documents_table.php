<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hacienda_documents', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 50)->unique();
            $table->string('numero_consecutivo');
            $table->string('document_type')->default('factura'); // factura, tiquete, nota_credito, nota_debito
            $table->string('fecha_emision')->nullable();
            $table->string('emisor')->nullable();
            $table->string('receptor')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->longText('raw_xml');
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('hacienda_document_id')->nullable()->after('quote_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hacienda_document_id');
        });

        Schema::dropIfExists('hacienda_documents');
    }
};
