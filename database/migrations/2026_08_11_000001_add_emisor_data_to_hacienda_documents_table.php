<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hacienda_documents', function (Blueprint $table) {
            $table->json('emisor_data')->nullable()->after('emisor');
        });
    }

    public function down(): void
    {
        Schema::table('hacienda_documents', function (Blueprint $table) {
            $table->dropColumn('emisor_data');
        });
    }
};
