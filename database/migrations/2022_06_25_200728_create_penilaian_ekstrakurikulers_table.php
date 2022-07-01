<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianEkstrakurikulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_ekstrakurikulers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstrakurikuler_id');
            $table->foreignId('nis');
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
        Schema::dropIfExists('penilaian_ekstrakurikulers');
    }
}
