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
        Schema::create('pinjaman_contents', function (Blueprint $table) {
            $table->id();
            $table->string('kode_karyawan');
            $table->string('ket_owner')->nullable();
            $table->string('kontrak')->nullable();
            $table->date('tanggal')->nullable();
            $table->double('bayar')->nullable();
            $table->double('sisa')->nullable();
            $table->string('jenis')->nullable();
            $table->boolean('menunggu')->nullable();
            $table->boolean('setuju')->nullable();
            $table->boolean('tolak')->nullable();
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
        Schema::dropIfExists('pinjaman_contents');
    }
};
