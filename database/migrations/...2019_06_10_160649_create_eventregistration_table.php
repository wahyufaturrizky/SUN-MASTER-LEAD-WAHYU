<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventregistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventregistration', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('form_id')->nullable();
            $table->string('studentName')->nullable();
            $table->string('educationGrade')->nullable();
            $table->bigInteger('mobilePhone')->nullable();
            $table->string('previousCurrentSchool')->nullable();
            $table->string('email')->nullable();
            $table->string('majorInterested')->nullable();
            $table->date('dateBirth')->nullable();
            $table->string('destinationStudy')->nullable();
            $table->string('gender')->nullable();
            $table->string('programInterested')->nullable();
            $table->string('parentsName')->nullable();
            $table->string('planningYear')->nullable();
            $table->bigInteger('parentsMobilePhone')->nullable();
            $table->text('fullAddress')->nullable();
            $table->bigInteger('postCode')->nullable();
            $table->bigInteger('homeAddressPhone')->nullable();
            $table->string('knowThisEvent')->nullable();
            $table->string('office')->nullable();
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
        Schema::dropIfExists('eventregistration');
    }
}
