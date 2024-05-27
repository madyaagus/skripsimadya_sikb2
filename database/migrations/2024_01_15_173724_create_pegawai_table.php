<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
                $table->id_pegawai();
                $table->string('nama_pegawai', 50);
                $table->bigInteger('id_pangkat');
                // $table->foreign('pangkat')->references('id')->on('pangkat')->onDelete('cascade');
                // $table->integer('id_pangkat')->nullable();
                // $table->foreign('id_pangkat')->references('id')->on('pangkat')->onDelete('set null');
                $table->string('jabatan',50)->nullable();
                $table->string('status', 15);
                $table->string('nip', 21);
                $table->string('nrp', 10);
                $table->string('alamat', 100)->nullable();
                $table->string('no_telp',12)->nullable();
                $table->string('status', 10);
                $table->string('foto', 100)->nullable();
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
        Schema::dropIfExists('pegawai');

        // Schema::table('pegawai', function (Blueprint $table) {
        //     $table->dropForeign(['id_pangkat']);
        //     $table->dropColumn('id_pangkat');
        // });
    }
}
