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
        Schema::create('catat_stok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kartu');
            $table->string('kode_barang');
            $table->integer('qty');
            $table->text('keterangan')->nullable();
            $table->string('proyek')->nullable();
            $table->string('pic')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('refrensi')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('kode_barang')->references('kode_barang')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catat_stok_barang');
    }
};
