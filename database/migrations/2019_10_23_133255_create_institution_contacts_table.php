<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_contacts', function (Blueprint $table) {
            $table->increments('institution_contact_id');
            $table->enum('type', ['Institution','Group']);
            $table->unsignedInteger('reference_id');
            $table->string('name', 64);
            $table->string('position', 100);
            $table->text('address');
            $table->string('phone', 16);
            $table->string('email');
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
        Schema::dropIfExists('institution_contacts');
    }
}
