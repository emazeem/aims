<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewappraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviewappraisals', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->integer('age');
            $table->string('basic_qualification');
            $table->integer('basic_qualification_duration');
            $table->string('highest_qualification');
            $table->integer('highest_qualification_duration');
            $table->string('bu_for_candidate');
            $table->string('relevant_experience');
            $table->string('total_experience');
            $table->string('last_salary');
            $table->string('desired_salary');
            $table->longText('personal_traits');
            $table->integer('suitable_for_other_department');
            $table->integer('evaluator');
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
        Schema::dropIfExists('interviewappraisals');
    }
}
