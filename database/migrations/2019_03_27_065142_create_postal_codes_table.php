<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->increments('postal_code_id');
            $table->string('postal_code_number'); // OK
            $table->string('kelurahan'); // OK
            $table->string('kecamatan'); // OK
            $table->string('jenis'); // OK
            $table->string('kabupaten'); // OK
            $table->string('propinsi'); // OK
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
        Schema::dropIfExists('postal_codes');
    }
}
