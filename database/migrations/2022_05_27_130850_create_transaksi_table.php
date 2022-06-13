<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('ID_TRANSAKSI');
            $table->unsignedInteger('ID_CUSTOMER')->nullable()->index('RELATION_332_FK');
            $table->unsignedInteger('ID_DRIVER')->nullable()->index('RELATION_340_FK');
            $table->unsignedInteger('ID_PEGAWAI')->nullable()->index('RELATION_342_FK');
            $table->string('KODE_PROMO', 4)->nullable()->index('RELATION_450_FK');
            $table->unsignedInteger('ID_MOBIL')->nullable()->index('RELATION_477_FK');
            $table->dateTime('TANGGAL_TRANSAKSI')->nullable();
            $table->dateTime('TANGGAL_MULAI_SEWA')->nullable();
            $table->dateTime('TANGGAL_SELESAI_SEWA')->nullable();
            $table->string('METODE_PEMBAYARAN', 10)->nullable();
            $table->string('STATUS_TRANSAKSI')->nullable();
            $table->float('TOTAL_BIAYA_SEWA', 10, 0)->nullable();
            $table->float('TOTAL_PEMBAYARAN', 10, 0)->nullable();
            $table->float('BIAYA_EKSTENSI_SEWA', 10, 0)->nullable();
            $table->dateTime('TANGGAL_PENGEMBALIAN')->nullable();
            $table->integer('RATING_DRIVER')->nullable();
            $table->integer('RATING_AJR')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
