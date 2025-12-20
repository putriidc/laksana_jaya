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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('no_kontrak')->nullable();
            $table->string('hari_kalender')->nullable();
            $table->string('nama_proyek');
            $table->string('nama_perusahaan');
            $table->string('pic');
            $table->string('kategori')->nullable();
            $table->string('jenis')->nullable();
            $table->double('nilai_kontrak')->default(0);
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable(); // manual soft delete
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
