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
        Schema::create('jurnal_umums', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jurnal');
            $table->date('tanggal');
            $table->string('keterangan')->nullable();
            $table->string('nama_perkiraan');
            $table->string('kode_perkiraan');
            $table->string('nama_proyek')->nullable();
            $table->string('kode_proyek')->nullable();
            $table->double('debit')->default(0);
            $table->double('kredit')->default(0);
            $table->timestamp('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable(); // manual soft delete
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_umums');
    }
};
