<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanBbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_bb', function (Blueprint $table) {
            $table->id_peminjaman();
            $table->date('tgl_peminjaman', 100);
            $table->bigInteger('terdakwa');
            $table->bigInteger('jaksa');
            $table->bigInteger('petugas_bb');
            $table->bigInteger('kasi_bb');
            $table->string('jadwal_ambil', 50)->nullable();
            $table->string('jadwal_kembali', 50)->nullable();
            $table->string('dokumentasi_bon', 150)->nullable();
            $table->string('status_peminjaman', 12);
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
        Schema::dropIfExists('peminjaman_bb');
    }
}
