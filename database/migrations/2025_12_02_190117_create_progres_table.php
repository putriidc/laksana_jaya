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
    Schema::create('progres', function (Blueprint $table) {
        $table->id();
        $table->string('kode_paket'); // relasi ke dataPerusahaan
        $table->integer('minggu');
        $table->integer('persen');
        $table->string('created_by')->nullable();
        $table->timestamp('deleted_at')->nullable();
        $table->timestamps();

        $table->foreign('kode_paket')->references('kode_paket')->on('data_perusahaans')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres');
    }
};
