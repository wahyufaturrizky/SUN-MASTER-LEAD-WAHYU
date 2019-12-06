<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_coverages', function (Blueprint $table) {
            $table->increments('branch_coverage_id');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('postal_code_id');
            $table->timestamps();

            $table->foreign('branch_id')->references('branch_id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('postal_code_id')->references('postal_code_id')->on('postal_codes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_coverages');
    }
}
