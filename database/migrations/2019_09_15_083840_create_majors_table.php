<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->increments('major_id');
            $table->unsignedInteger('field_of_study_id');
            $table->string('major_name', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('field_of_study_id')->references('field_of_study_id')->on('field_of_studies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('majors');
    }
}
