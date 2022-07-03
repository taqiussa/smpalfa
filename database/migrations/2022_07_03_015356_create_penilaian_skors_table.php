<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSkorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_skors', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('tahun');
            $table->string('semester')->nullable();
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('skor_id');
            $table->integer('skor');
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
        Schema::dropIfExists('penilaian_skors');
    }
}
