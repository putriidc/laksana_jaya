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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->unique()->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_alat')->nullable();
            $table->string('kategori')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('stok')->default(0)->nullable();
            $table->text('foto')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
