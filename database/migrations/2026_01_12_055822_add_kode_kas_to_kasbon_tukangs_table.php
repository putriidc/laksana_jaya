<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kasbon_tukangs', function (Blueprint $table) {
            $table->string('kode_kas')->nullable()->after('nama_proyek');
        });
    }

    public function down()
    {
        Schema::table('kasbon_tukangs', function (Blueprint $table) {
            $table->dropColumn('kode_kas');
        });
    }
};
