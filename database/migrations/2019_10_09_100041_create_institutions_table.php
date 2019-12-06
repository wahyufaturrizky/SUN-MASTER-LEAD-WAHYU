<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('institution_id');
            $table->string('institution_name', 200);
            $table->string('acronym', 15)->nullable();
            $table->string('country_id', 4);
            $table->tinyInteger('point')->nullable();
            $table->tinyInteger('point_until')->nullable();
            $table->tinyInteger('target')->nullable();
            $table->tinyInteger('tier')->nullable();
            $table->string('status', 25)->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('change_to')->nullable();
            $table->double('incentive')->nullable();
            $table->boolean('is_partnership')->default(true);
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
        Schema::dropIfExists('institutions');
    }
}
