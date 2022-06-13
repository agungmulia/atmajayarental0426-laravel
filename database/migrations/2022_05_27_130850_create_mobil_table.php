<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->increments('ID_MOBIL');
            $table->unsignedInteger('ID_MITRA')->nullable()->index('RELATION_476_FK');
            $table->string('NAMA_MOBIL', 20)->nullable();
            $table->string('TIPE_MOBIL', 10)->nullable();
            $table->string('JENIS_TRANSMISI_MOBIL', 3)->nullable();
            $table->string('JENIS_BAHAN_BAKAR_MOBIL', 20)->nullable();
            $table->string('WARNA_MOBIL', 20)->nullable();
            $table->float('VOLUME_BAGASI_MOBIL', 10, 0)->nullable();
            $table->string('FASILITAS_MOBIL', 50)->nullable();
            $table->float('HARGA_SEWA_HARIAN_MOBIL', 10, 0)->nullable();
            $table->integer('KAPASITAS_PENUMPANG')->nullable();
            $table->integer('NO_STNK')->nullable();
            $table->string('KATEGORI_ASET', 10)->nullable();
            $table->string('STATUS_KETERSEDIAAN', 20)->nullable();
            $table->date('TANGGAL_SERVICE')->nullable();
            $table->float('VOLUME_BAHAN_BAKAR', 10, 0)->nullable();
            $table->date('KONTRAK_MULAI')->nullable();
            $table->date('KONTRAK_SELESAI')->nullable();
            $table->longText('FOTO_MOBIL')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil');
    }
}
