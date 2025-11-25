<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sampingans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->double('gaji')->nullable();
            $table->integer('hari')->nullable();
            $table->double('tambahan')->nullable();
            $table->double('kasbon')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable(); // manual soft delete
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sampingans');
    }
};

