<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpcontractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empcontracts', function (Blueprint $table) {
            $table->id();
            $table->integer('appraisal_id');
            $table->string('termination_period');
            $table->integer('probation_applicable');
            $table->string('probation_period');
            $table->integer('designations');
            $table->string('place_of_work');
            $table->integer('salary');
            $table->integer('allowances');
            $table->integer('cnic');
            $table->integer('signature')->nullable();
            $table->integer('hr_user_id')->nullable();
            $table->date('joining')->nullable();
            $table->integer('representative');
            $table->date('commencement');
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
        Schema::dropIfExists('empcontracts');
    }
}
