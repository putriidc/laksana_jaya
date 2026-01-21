<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambah kolom di pinjaman_contents
        Schema::table('pinjaman_contents', function (Blueprint $table) {
            $table->string('kode_kas')->nullable()->after('kode_karyawan');
        });

        // Tambah kolom di kasbon_contents
        Schema::table('kasbon_contents', function (Blueprint $table) {
            $table->string('kode_kas')->nullable()->after('kode_karyawan');
        });
    }

    public function down(): void
    {
        // Rollback: hapus kolom
        Schema::table('pinjaman_contents', function (Blueprint $table) {
            $table->dropColumn('kode_kas');
        });

        Schema::table('kasbon_contents', function (Blueprint $table) {
            $table->dropColumn('kode_kas');
        });
    }
};

