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
        Schema::table('jurnal_umums', function (Blueprint $table) {
            $table->string('kode_vendor')->nullable()->after('id_kasbon');
        });
    }
    public function down(): void
    {
        Schema::table('jurnal_umums', function (Blueprint $table) {
            $table->dropColumn('kode_vendor');
        });
    }
};
