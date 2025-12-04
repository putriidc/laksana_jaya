<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perusahaan'); // relasi ke perusahaan
            $table->string('kode_paket')->unique();
            $table->string('nama_paket');
            $table->string('pic')->nullable();
            $table->string('no_hp')->nullable();
            $table->date('mc0')->nullable();
            $table->string('korlap')->nullable();
            $table->string('kontraktor')->nullable();
            $table->date('tgl_pho')->nullable();
            $table->date('tgl_ambil')->nullable();
            $table->string('kendala')->nullable();
            $table->boolean('is_pho')->default(false);
            $table->boolean('is_kontraktor_admin')->default(false);
            $table->boolean('is_pengawas_admin')->default(false);
            $table->boolean('is_kontraktor_kontraktor')->default(false);
            $table->boolean('is_konsultan_kontraktor')->default(false);
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('kode_perusahaan')->references('kode_perusahaan')->on('perusahaans')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perusahaans');
    }
};
