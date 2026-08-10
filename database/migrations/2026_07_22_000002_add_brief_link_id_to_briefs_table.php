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
        Schema::table('briefs', function (Blueprint $table) {
            $table->foreignId('brief_link_id')->nullable()->after('id')->constrained('brief_links')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('briefs', function (Blueprint $table) {
            $table->dropForeign(['brief_link_id']);
            $table->dropColumn('brief_link_id');
        });
    }
};
