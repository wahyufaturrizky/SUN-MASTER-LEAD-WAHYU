<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_sources', function (Blueprint $table) {
            $table->increments('marketing_source_id');
            $table->string('marketing_source_name');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('register_type')->nullable();
            $table->string('tags')->nullable();
            $table->string('sequence')->nullable();
            $table->string('change_to')->nullable();
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
        Schema::dropIfExists('marketing_sources');
    }
}
