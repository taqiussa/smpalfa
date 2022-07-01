<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToPrestasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->string('keterangan');
            $table->foreignId('kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->dropColumn('kelas_id');
        });
    }
}
