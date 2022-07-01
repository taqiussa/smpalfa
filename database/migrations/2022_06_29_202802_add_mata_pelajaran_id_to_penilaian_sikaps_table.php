<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMataPelajaranIdToPenilaianSikapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_sikaps', function (Blueprint $table) {
            $table->foreignId('mata_pelajaran_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_sikaps', function (Blueprint $table) {
            $table->dropColumn('mata_pelajaran_id');
        });
    }
}
