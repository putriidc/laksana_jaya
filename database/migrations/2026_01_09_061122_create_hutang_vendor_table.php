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
        Schema::create('hutang_vendor', function (Blueprint $table) {
            $table->id();
            $table->string('kode_vendor')->unique();
            $table->date('tgl_hutang');
            $table->date('tgl_jatuh_tempo');
            $table->string('kode_supplier'); // relasi ke supplier.kode_akun
            $table->double('nominal');
            $table->string('kode_proyek');   // relasi ke proyek.kode_akun
            $table->text('keterangan')->nullable();
            $table->boolean('is_generate')->default(false);
            $table->string('created_by')->nullable();
            $table->softDeletes(); // deleted_at
            $table->timestamps();  // created_at & updated_at
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutang_vendor');
    }
};
