<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBa20Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_20', function (Blueprint $table) {
            $table->id_ba20();
            $table->bigInteger('terdakwa');
            $table->string('hari', 6);
            $table->date('tanggal');
            $table->bigInteger('jaksa');
            $table->string('dikembalikan', 100);
            $table->string('nama_penerima', 50);
            $table->string('pekerjaan_ba20', 50);
            $table->text('alamat_ba20');
            $table->bigInteger('kasi_bb');
            $table->bigInteger('saksi1');
            $table->bigInteger('saksi2');
            $table->text('barang_bukti_ba20');
            $table->string('dokumentasi', 150)->nullable();
            $table->string('arsip', 150)->nullable();
            $table->string('status_ba20', 17);

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
        Schema::dropIfExists('ba_20');
    }
}
