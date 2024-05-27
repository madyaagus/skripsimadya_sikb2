<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBensusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bensus', function (Blueprint $table) {
            $table->id_bensus();
            $table->string('hari', 6);
            $table->date('tgl_bensus');
            $table->bigInteger('jaksa');
            $table->bigInteger('terdakwa');
            $table->bigInteger('jumlah_uang');
            $table->string('keterangan_uang', 50);
            $table->bigInteger('bendahara');
            $table->string('tujuan_setoran', 25);
            $table->string('bank_setoran', 50);
            $table->string('alamat_bank', 50);
            $table->bigInteger('saksi1');
            $table->bigInteger('saksi2');
            $table->string('arsip', 150)->nullable();
            $table->string('status_bensus', 17)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bensus');
    }
}
