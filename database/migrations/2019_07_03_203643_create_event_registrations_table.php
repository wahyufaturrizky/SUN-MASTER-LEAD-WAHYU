<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->increments('event_registration_id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('event_type_id');
            $table->string('register_id');
            $table->string('full_name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('birth');
            $table->enum('gender',['m','f']);
            $table->string('parents_name');
            $table->string('parents_mobile');
            $table->string('address');
            $table->string('zip_code'); // postal_code_number
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('dt2'); // jenis
            $table->string('kabupaten');
            $table->string('propinsi');
            $table->string('phone');
            $table->unsignedInteger('highest_edu_id');
            $table->string('highest_edu');
            $table->unsignedInteger('precur_school_id');
            $table->string('precur_school');
            $table->unsignedInteger('major_interested_id');
            $table->string('major_interested');
            $table->string('destination_of_study_id');
            $table->string('destination_of_study');
            $table->unsignedInteger('program_interested_id');
            $table->string('program_interested');
            $table->string('planning_year');
            $table->integer('marketing_source_id');
            $table->string('marketing_source');
            $table->enum('has_contact_sun',['Yes','No'])->default('No');
            $table->string('branch_id');
            $table->string('branch_name');

            // $table->softDeletes();
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
        Schema::dropIfExists('event_registrations');
    }
}
