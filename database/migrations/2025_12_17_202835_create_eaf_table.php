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
        Schema::create('eaf', function (Blueprint $table) {
            $table->id();
            $table->string('kode_eaf')->unique();
            $table->date('tanggal');
            $table->string('nama_proyek');
            $table->string('pic');
            $table->string('keterangan');
            $table->string('kas');
            $table->integer('nominal');
            $table->string('acc_owner')->nullable();
            $table->string('acc_spv')->nullable();
            $table->string('ket_owner')->nullable();
            $table->string('ket_spv')->nullable();
            $table->text('detail_biaya')->nullable();
            $table->string('created_by');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eaf');
    }
};
