<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('client_address')->nullable()->after('client_id_number');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('client_address')->nullable()->after('client_id_number');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('client_address');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('client_address');
        });
    }
};
