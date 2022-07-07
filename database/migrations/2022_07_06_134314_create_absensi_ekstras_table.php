<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiEkstrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_ekstras', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('tahun');
            $table->string('semester');
            $table->foreignId('ekstrakurikuler_id');
            $table->foreignId('kelas_id');
            $table->foreignId('nis');
            $table->foreignId('kehadiran_id');
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
        Schema::dropIfExists('absensi_ekstras');
    }
}
