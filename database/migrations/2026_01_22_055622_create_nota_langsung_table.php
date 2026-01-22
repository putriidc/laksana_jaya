<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nota_langsung', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nota');
            $table->date('tanggal');
            $table->string('nama_proyek');
            $table->string('kode_akun');
            $table->string('kode_kas')->nullable();
            $table->string('pic')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('nominal');
            $table->text('detail_biaya')->nullable();
            $table->string('created_by');
            $table->softDeletes(); // deleted_at
            $table->timestamps();  // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_langsung');
    }
};
