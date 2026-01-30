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
        Schema::table('eaf', function (Blueprint $table) {
            $table->string('is_open')->nullable()->default('close')->after('detail_biaya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eaf', function (Blueprint $table) {
            $table->dropColumn('is_open');
        });
    }
};
