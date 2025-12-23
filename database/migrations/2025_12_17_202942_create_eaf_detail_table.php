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
        Schema::create('eaf_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kode_eaf'); // foreign key ke eaf.kode_eaf
            $table->date('tanggal');
            $table->string('kode_akun');
            $table->string('nama_akun');
            $table->string('keterangan');
            $table->string('kategori')->nullable();
            $table->integer('debit')->default(0)->nullable();
            $table->integer('kredit')->default(0)->nullable();
            $table->boolean('is_generate')->nullable();
            $table->string('created_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kode_eaf')->references('kode_eaf')->on('eaf')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eaf_detail');
    }
};
