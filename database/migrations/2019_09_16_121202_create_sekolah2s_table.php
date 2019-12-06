<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolah2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah2s', function (Blueprint $table) {
            $table->increments('sekolah_id');
            $table->string('kode_prop')->nullable();
            $table->string('propinsi')->nullable();
            $table->string('kode_kab_kota')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('kode_kec')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('id')->nullable();
            $table->string('npsn')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('bentuk')->nullable();
            $table->string('status')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
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
        Schema::dropIfExists('sekolah2s');
    }
}
