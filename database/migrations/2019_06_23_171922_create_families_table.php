<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('familyCard_id')->nullable();
            $table->string('familyName')->nullable();
            $table->string('email')->nullable();
            $table->string('familyMobilePhone')->nullable();
            $table->string('homeAddressPhone')->nullable();
            $table->string('fatherName')->nullable();
            $table->date('dobf')->nullable();
            $table->string('motherName')->nullable();
            $table->date('dobm')->nullable();
            $table->string('postCode')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('families');
    }
}
