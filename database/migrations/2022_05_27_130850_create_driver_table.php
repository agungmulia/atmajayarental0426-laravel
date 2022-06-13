<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->increments('ID_DRIVER');
            $table->string('NAMA_DRIVER', 100)->nullable();
            $table->string('ALAMAT_DRIVER', 50)->nullable();
            $table->date('TANGGAL_LAHIR_DRIVER')->nullable();
            $table->string('JENIS_KELAMIN_DRIVER', 10)->nullable();
            $table->string('EMAIL_DRIVER')->nullable();
            $table->string('NO_TELP_DRIVER', 13)->nullable();
            $table->decimal('BAHASA_ASING', 1, 0)->nullable();
            $table->string('PASSWORD_DRIVER', 50)->nullable();
            $table->longText('FOTO_DRIVER')->nullable();
            $table->longText('SIM_DRIVER')->nullable();
            $table->longText('SURAT_BEBAS_NAPZA')->nullable();
            $table->longText('SKCK')->nullable();
            $table->longText('SURAT_KESEHATAN')->nullable();
            $table->float('TARIF_DRIVER', 10, 0)->nullable();
            $table->string('STATUS_KETERSEDIAAN', 20)->nullable();
            $table->integer('RATING')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver');
    }
}
