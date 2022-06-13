<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('ID_CUSTOMER');
            $table->string('NAMA_CUSTOMER', 50)->nullable();
            $table->string('ALAMAT_CUSTOMER', 100)->nullable();
            $table->date('TANGGAL_LAHIR')->nullable();
            $table->string('JENIS_KELAMIN', 10)->nullable();
            $table->string('EMAIL_CUSTOMER', 50)->nullable();
            $table->string('NO_TELP_CUSTOMER', 13)->nullable();
            $table->integer('JUMLAH_TRANSAKSI')->nullable();
            $table->string('PASSWORD_CUSTOMER', 50)->nullable();
            $table->string('SIM_CUSTOMER', 20)->nullable();
            $table->longText('FOTO_CUSTOMER')->nullable();
            $table->longText('KTP_CUSTOMER');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}