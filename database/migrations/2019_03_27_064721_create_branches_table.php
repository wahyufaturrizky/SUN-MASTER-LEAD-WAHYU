<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('branch_id');
            $table->string('branch_code');
            $table->string('branch_name');
            $table->enum('branch_area',['Jakarta','Outstation']); // Area umum. Jakarta atau Outstation. Untuk yg module Branching kaya sunnies dibikin table lagi nantinya, untuk koneksi branch dan kode pos nya.
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
        Schema::dropIfExists('branches');
    }
}
