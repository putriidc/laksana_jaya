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
        Schema::create('pinjaman_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_karyawan');
            $table->string('nama_karyawan');
            $table->double('total_pinjam')->default(0);
            $table->double('total_kasbon')->default(0);
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
        Schema::dropIfExists('pinjaman_karyawans');
    }
};
