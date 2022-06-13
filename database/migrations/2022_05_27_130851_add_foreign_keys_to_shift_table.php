<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shift', function (Blueprint $table) {
            $table->foreign(['ID_PEGAWAI'], 'shift_ibfk_2')->references(['ID_PEGAWAI'])->on('pegawai');
            $table->foreign(['ID_SHIFT'], 'shift_ibfk_1')->references(['ID_SHIFT'])->on('jadwal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shift', function (Blueprint $table) {
            $table->dropForeign('shift_ibfk_2');
            $table->dropForeign('shift_ibfk_1');
        });
    }
}
