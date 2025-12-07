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
        Schema::create('kasbon_tukangs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_kasbon')->unique();
            $table->string('nama_tukang');
            $table->string('nama_akun')->nullable();
            $table->string('nama_proyek')->nullable();
            $table->double('total')->default(0)->nullable();
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
        Schema::dropIfExists('kasbon_tukangs');
    }
};
