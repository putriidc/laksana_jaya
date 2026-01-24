<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakPinjamTable extends Migration
{
    public function up()
    {
        Schema::create('kontrak_pinjam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pinjaman_content'); // foreign key ke PinjamanContent
            $table->string('jangka_waktu');
            $table->integer('angsuran');
            $table->string('created_by');
            $table->softDeletes();
            $table->timestamps();

            // relasi ke pinjaman_contents
            $table->foreign('id_pinjaman_content')
                  ->references('id')
                  ->on('pinjaman_contents')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontrak_pinjam');
    }
}
