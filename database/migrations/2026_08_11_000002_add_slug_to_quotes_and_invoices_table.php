<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('slug', 32)->nullable()->unique()->after('quote_number');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('slug', 32)->nullable()->unique()->after('invoice_number');
        });

        foreach (['quotes', 'invoices'] as $table) {
            DB::table($table)->whereNull('slug')->orderBy('id')->each(function ($row) use ($table) {
                do {
                    $slug = Str::random(16);
                } while (DB::table($table)->where('slug', $slug)->exists());

                DB::table($table)->where('id', $row->id)->update(['slug' => $slug]);
            });
        }
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
