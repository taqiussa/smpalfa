<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaEkstrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_ekstras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nis');
            $table->foreignId('kelas_id');
            $table->foreignId('ekstrakurikuler_id');
            $table->string('tingkat')->nullable();
            $table->string('tahun');
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
        Schema::dropIfExists('siswa_ekstras');
    }
}
