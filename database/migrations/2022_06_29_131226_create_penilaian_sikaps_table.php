<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSikapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sikaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sikap_id');
            $table->foreignId('jenis_sikap_id');
            $table->foreignId('nis');
            $table->foreignId('kelas_id');
            $table->string('tahun');
            $table->string('semester');
            $table->integer('nilai');
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
        Schema::dropIfExists('penilaian_sikaps');
    }
}
