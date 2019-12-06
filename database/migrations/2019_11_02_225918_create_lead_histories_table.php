<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_histories', function (Blueprint $table) {
            $table->increments('lead_history_id');
            $table->uuid('leads_uuid');
            $table->string('reference_id', 64);
            $table->string('reference_type', 32);
            $table->string('from', 10); // From Sunnies or Suntrack or Etc...
            $table->string('to', 10); // From Sunnies or Suntrack or Etc...
            $table->string('allocated_to', 32);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('leads_uuid')->references('leads_uuid')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_histories');
    }
}
