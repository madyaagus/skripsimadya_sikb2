<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerdakwaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terdakwa', function (Blueprint $table) {
            $table->id_terdakwa();
            $table->string('nama_terdakwa', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->string('umur', 3);
            $table->string('jenis_kelamin', 9);
            $table->string('kebangsaan', 20);
            $table->string('agama', 20);
            $table->text('alamat_terdakwa');
            $table->string('pekerjaan', 50);
            $table->string('reg_perkara', 25);
            $table->string('reg_bukti', 25);
            $table->date('tgl_penyitaan');
            $table->date('tgl_penerimaan_bb');
            $table->text('pasal');
            $table->bigInteger('jaksa1');
            $table->bigInteger('jaksa2')->nullable();
            $table->string('nama_penyidik', 25);
            $table->string('pangkat_nrp_penyidik', 30);
            $table->string('print_p48', 32)->nullable();
            $table->date('tgl_p48')->nullable();
            $table->string('no_putusan', 30)->nullable();
            $table->date('tgl_putusan')->nullable();
            $table->text('barang_bukti')->nullable();
            $table->string('status_barang_bukti', 19)->nullable();
            $table->string('status_eksekusi', 12)->nullable();
            $table->text('keterangan_eksekusi')->nullable();
            $table->text('keterangan_putusan')->nullable();
            $table->bigInteger('petugas_bb')->nullable();
            $table->string('putusan_penahanan', 50)->nullable();
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
        Schema::dropIfExists('terdakwa');
    }
}
