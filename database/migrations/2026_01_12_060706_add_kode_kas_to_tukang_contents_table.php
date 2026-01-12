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
        Schema::table('tukang_contents', function (Blueprint $table) {
            $table->string('kode_kas')->nullable()->after('kode_kasbon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tukang_contents', function (Blueprint $table) {
            $table->dropColumn('kode_kas');
        });
    }
};
