<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchSunEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_sun_education', function (Blueprint $table) {
            $table->increments('branch_sun_education_id');
            $table->string('branch_name');
            $table->string('branch_code', 10);
            $table->text('branch_coverage');
            $table->enum('branch_area',['Jakarta','Outstation']);
            $table->tinyInteger('sequence')->nullable();
            $table->unsignedInteger('branch_sun_english_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_sun_education');
    }
}
