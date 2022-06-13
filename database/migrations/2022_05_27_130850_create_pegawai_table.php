<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('ID_PEGAWAI');
            $table->integer('ID_ROLE')->index('RELATION_435_FK');
            $table->string('NAMA_PEGAWAI', 50)->nullable();
            $table->string('ALAMAT_PEGAWAI', 50)->nullable();
            $table->date('TANGGAL_LAHIR')->nullable();
            $table->string('JENIS_KELAMIN', 10)->nullable();
            $table->string('NO_TELP_PEGAWAI', 13)->nullable();
            $table->string('EMAIL_PEGAWAI', 20)->nullable();
            $table->longText('FOTO_PEGAWAI')->nullable();
            $table->string('PASSWORD_PEGAWAI', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
