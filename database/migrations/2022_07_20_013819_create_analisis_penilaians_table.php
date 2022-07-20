<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_penilaians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nis');
            $table->foreignId('kategori_nilai_id');
            $table->foreignId('jenis_penilaian_id');
            $table->foreignId('kelas_id');
            $table->foreignId('mata_pelajaran_id');
            $table->string('semester');
            $table->string('tahun');
            $table->integer('no_1')->nullable();
            $table->integer('no_2')->nullable();
            $table->integer('no_3')->nullable();
            $table->integer('no_4')->nullable();
            $table->integer('no_5')->nullable();
            $table->integer('no_6')->nullable();
            $table->integer('no_7')->nullable();
            $table->integer('no_8')->nullable();
            $table->integer('no_9')->nullable();
            $table->integer('no_10')->nullable();
            $table->integer('nilai');
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('analisis_penilaians');
    }
}
