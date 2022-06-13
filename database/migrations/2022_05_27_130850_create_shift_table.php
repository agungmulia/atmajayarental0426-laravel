<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift', function (Blueprint $table) {
            $table->integer('ID_SHIFT');
            $table->unsignedInteger('ID_PEGAWAI')->index('ID_PEGAWAI');

            $table->unique(['ID_SHIFT', 'ID_PEGAWAI'], 'RELATION_436_PK');
            $table->primary(['ID_SHIFT', 'ID_PEGAWAI']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift');
    }
}
