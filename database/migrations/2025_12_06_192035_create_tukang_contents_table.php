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
        Schema::create('tukang_contents', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_kasbon'); // relasi ke kasbon_tukangs
            $table->string('ket_spv')->nullable();
            $table->string('ket_owner')->nullable();
            $table->string('status_spv')->nullable();
            $table->string('status_owner')->nullable();
            $table->string('jenis')->nullable();
            $table->string('kontrak')->nullable();
            $table->double('bayar')->default(0);
            $table->double('sisa')->default(0);
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // foreign key ke kasbon_tukangs
            $table->foreign('kode_kasbon')
                  ->references('kode_kasbon')
                  ->on('kasbon_tukangs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tukang_contents');
    }
};
