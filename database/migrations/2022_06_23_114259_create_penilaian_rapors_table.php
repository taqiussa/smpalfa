<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianRaporsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_rapors', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat')->nullable();
            $table->string('tahun');
            $table->string('semester');
            $table->foreignId('kategori_nilai_id');
            $table->foreignId('jenis_penilaian_id');
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
        Schema::dropIfExists('penilaian_rapors');
    }
}
