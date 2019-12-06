<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionGroupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_group_details', function (Blueprint $table) {
            $table->increments('institution_group_detail_id');
            $table->unsignedInteger('institution_group_id');
            $table->unsignedInteger('institution_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('institution_group_id')->references('institution_group_id')->on('institution_groups');
            $table->foreign('institution_id')->references('institution_id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_group_details');
    }
}
