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
        Schema::create('kontrak_proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_proyek'); // relasi ke Proyek via kode_proyek
            $table->string('nama_proyek');
            $table->bigInteger('nilai_kontrak')->default(0);
            $table->bigInteger('dpp')->default(0);
            $table->decimal('ppn_persen', 5, 2)->default(11.00);
            $table->bigInteger('ppn')->default(0);
            $table->bigInteger('pph')->default(0);
            $table->decimal('pph_persen', 5, 2)->default(0);
            $table->bigInteger('sisa_potong_pajak')->default(0);
            $table->decimal('fee_dinas_persen', 5, 2)->default(0);
            $table->bigInteger('fee_dinas')->default(0);
            $table->decimal('net_persen', 5, 2)->default(0);
            $table->bigInteger('net')->default(0);
            $table->bigInteger('keuntungan')->default(0);
            $table->bigInteger('real_untung')->default(0);
            $table->boolean('is_generate')->nullable();
            $table->string('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // index untuk performa
            $table->index('kode_proyek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_proyeks');
    }
};
