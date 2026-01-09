<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hutang_vendor', function (Blueprint $table) {
            $table->date('tgl_bayar')->nullable();       // kolom tanggal bayar
            $table->string('kode_akun')->nullable();     // kolom kode akun
        });
    }

    public function down(): void
    {
        Schema::table('hutang_vendor', function (Blueprint $table) {
            $table->dropColumn(['tgl_bayar', 'kode_akun']);
        });
    }
};
