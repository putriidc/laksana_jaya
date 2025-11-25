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
            $table->date('tanggal');
            $table->string('kode_karyawan');
            $table->double('total_pinjam')->default(0)->nullable();
            $table->double('total_kasbon')->default(0)->nullable();
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
        Schema::dropIfExists('pinjaman_karyawans');
    }
};
