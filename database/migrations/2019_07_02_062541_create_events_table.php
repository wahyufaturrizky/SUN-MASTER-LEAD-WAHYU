<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->string('event_name');
            $table->unsignedInteger('event_type_id');
            $table->unsignedInteger('event_group_id')->nullable();
            $table->string('abbreviation'); // singkatan // Reference to generate form id
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('location')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('slug');
            $table->string('marketing_source_ids')->nullable();
            $table->datetime('event_close')->nullable();
            $table->boolean('is_open');
            $table->unsignedInteger('last_number');
            $table->timestamps();

            $table->foreign('event_type_id')->references('event_type_id')->on('event_types');
            $table->foreign('event_group_id')->references('event_group_id')->on('event_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
