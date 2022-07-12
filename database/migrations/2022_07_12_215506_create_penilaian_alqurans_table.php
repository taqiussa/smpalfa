<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianAlquransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_alqurans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('nis');
            $table->foreignId('kelas_id')->nullable();
            $table->string('tahun')->nullable();
            $table->string('semester')->nullable();
            $table->foreignId('kategori_alquran_id');
            $table->foreignId('jenis_alquran_id');
            $table->integer('nilai');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_alqurans');
    }
}
