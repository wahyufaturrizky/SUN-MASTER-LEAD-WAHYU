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
            $table->unsignedInteger('school_type_id')->default(0);
            $table->unsignedInteger('country_id')->default(0);
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('kelurahan')->nullable(); // OK
            $table->string('kecamatan')->nullable(); // OK
            $table->string('jenis')->nullable(); // OK
            $table->string('kabupaten')->nullable(); // OK
            $table->string('propinsi')->nullable(); // OK

            // $table->string('address')->nullable();
            // $table->string('kode_prop')->nullable();
            // $table->string('propinsi')->nullable();
            // $table->string('kode_kab_kota')->nullable();
            // $table->string('kabupaten_kota')->nullable();
            // $table->string('kode_kec')->nullable();
            // $table->string('kecamatan')->nullable();
            // $table->string('id')->nullable();
            // $table->string('npsn')->nullable();
            // $table->string('sekolah');
            // $table->string('bentuk')->nullable();
            // $table->string('status')->nullable();
            // $table->text('alamat_jalan')->nullable();
            // $table->string('lintang')->nullable();
            // $table->string('bujur')->nullable();
            $table->timestamps();

            $table->foreign('school_type_id')->references('school_type_id')->on('school_types');
            $table->foreign('country_id')->references('country_id')->on('countries');
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
