<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('school_id');
            $table->unsignedInteger('kode_prop');
            $table->string('propinsi');
            $table->unsignedInteger('kode_kab_kota');
            $table->string('kabupaten_kota');
            $table->unsignedInteger('kode_kec');
            $table->string('kecamatan');
            // $table->string('uuid')->nullable();
            $table->string('npsn');
            $table->string('sekolah');
            $table->string('bentuk');
            $table->string('status');
            $table->text('alamat_jalan');
            $table->string('lintang');
            $table->string('bujur');
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
        Schema::dropIfExists('schools');
    }
}
