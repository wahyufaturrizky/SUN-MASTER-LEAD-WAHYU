<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('registration_id');
            $table->enum('registration_type',['education-expo','seminar','workshop','info-session'])->nullable();
            $table->string('full_name');
            $table->string('mobile');
            $table->string('birth');
            $table->enum('gender',['m','f']);
            $table->string('parents_name');
            $table->string('parents_mobile');
            $table->string('address');
            $table->string('zip_code');
            // $table->string('kelurahan');
            // $table->string('kecamatan');
            // $table->string('dt2');
            // $table->string('kabupaten');
            // $table->string('provinsi');
            $table->string('phone'); // Fixed Phone
            $table->unsignedInteger('highest_edu_id')->nullable();
            $table->string('highest_edu')->nullable();
            $table->unsignedInteger('precur_school_id')->nullable();
            $table->string('precur_school')->nullable();
            $table->unsignedInteger('major_interested_id')->nullable();
            $table->string('major_interested')->nullable();
            $table->string('destination_of_study_id')->nullable();
            $table->string('destination_of_study')->nullable();
            $table->unsignedInteger('program_interested_id')->nullable();
            $table->string('program_interested')->nullable();
            $table->tinyInteger('marketing_source_id')->nullable();
            $table->string('marketing_source')->nullable();
            $table->string('planning_year')->nullable();
            $table->string('has_contact_sun')->default(false);
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
