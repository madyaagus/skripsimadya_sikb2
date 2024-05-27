<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBa23Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_23', function (Blueprint $table) {
            $table->id_ba23();
            $table->string('hari', 6);
            $table->date('tgl_ba23');
            $table->bigInteger('jaksa');
            $table->bigInteger('terdakwa');
            $table->bigInteger('kasi_bb');
            $table->bigInteger('saksi1');
            $table->bigInteger('saksi2');
            $table->text('barang_bukti_ba23');
            $table->string('arsip', 150)->nullable();
            $table->string('status', 17)->nullable();
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
        Schema::dropIfExists('ba_23');
    }
}
