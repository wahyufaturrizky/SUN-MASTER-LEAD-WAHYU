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
            // Sun Edu dan Sun English
            // Sun Edu:
            // 1. Homepage
            // 2. Program
            // 3. Events
            // 3.1. education-expo
            // 3.2. seminar
            // 3.3. workshop
            // 3.4. info-session

            // For General
            $table->string('marketing_source_type')->nullable();
            $table->enum('registration_type',['sun-edu-general-registration','sun-edu-apply-program','sun-edu-info-session','sun-edu-seminar','sun-edu-workshop','sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl']);
            $table->string('full_name');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('birth')->nullable();
            $table->enum('gender',['m','f'])->nullable();
            $table->string('parents_name')->nullable();
            $table->string('parents_mobile')->nullable();
            $table->string('parents_email')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('dt2')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('fixed_phone')->nullable(); // Fixed Phone
            $table->unsignedInteger('highest_edu_id')->nullable();
            $table->string('highest_edu')->nullable();
            $table->unsignedInteger('precur_school_id')->nullable();
            $table->string('precur_school')->nullable();
            $table->unsignedInteger('reference_program_id')->nullable();
            $table->string('reference_program_name')->nullable();
            $table->unsignedInteger('reference_university_id')->nullable();
            $table->string('reference_university_name')->nullable();
            $table->unsignedInteger('major_interested_id')->nullable();
            $table->string('major_interested')->nullable();
            $table->string('destination_of_study_id')->nullable();
            $table->string('destination_of_study')->nullable();
            $table->unsignedInteger('program_interested_id')->nullable(); // Phd, Diploma, dll
            $table->string('program_interested')->nullable();
            $table->tinyInteger('marketing_source_id')->nullable();
            $table->string('marketing_source')->nullable();
            $table->string('planning_year')->nullable();
            $table->boolean('has_contact_sun')->default(false);
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('form_id')->nullable();

            // For Sun English
            $table->enum('type_student',['Corporate','Employee','Student'])->nullable();
            $table->string('program_name')->nullable(); // IELTS / TOEFL / DLL
            $table->text('message')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('form_id')->references('form_id')->on('forms');
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
