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
        Schema::create('alat_dibeli', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat'); // relasi ke barang
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('qty')->default(0);
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // foreign key ke barang
            $table->foreign('kode_alat')->references('kode_alat')->on('alats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_dibeli');
    }
};
