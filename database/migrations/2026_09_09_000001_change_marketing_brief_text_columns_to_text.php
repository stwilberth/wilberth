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
        Schema::table('marketing_briefs', function (Blueprint $table) {
            $table->text('offer')->change();
            $table->text('target_audience')->change();
            $table->text('differentiator')->change();
            $table->text('main_goal')->change();
            $table->text('promoted_service')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_briefs', function (Blueprint $table) {
            $table->string('offer')->change();
            $table->string('target_audience')->change();
            $table->string('differentiator')->change();
            $table->string('main_goal')->change();
            $table->string('promoted_service')->change();
        });
    }
};