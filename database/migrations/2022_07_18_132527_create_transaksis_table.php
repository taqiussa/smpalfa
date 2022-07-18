<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('tahun');
            $table->string('semester')->nullable();
            $table->string('tingkat')->nullable();
            $table->foreignId('nis')->nullable();
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('kategori_pemasukan_id');
            $table->foreignId('gunabayar_id')->nullable();
            $table->bigInteger('jumlah');
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
        Schema::dropIfExists('transaksis');
    }
}
