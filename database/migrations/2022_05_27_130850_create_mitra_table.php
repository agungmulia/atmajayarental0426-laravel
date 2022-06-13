<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->increments('ID_MITRA');
            $table->string('NAMA_MITRA', 30)->nullable();
            $table->string('ALAMAT_MITRA', 50)->nullable();
            $table->string('NO_TELEPON_MITRA', 15)->nullable();
            $table->string('NO_KTP_MITRA', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitra');
    }
}
