<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('appraisal_id');
            $table->string('nature_of_leave');
            $table->integer('type_of_leave');
            $table->integer('type_time')->nullable();
            $table->date('from');
            $table->date('to');
            $table->string('reason');
            $table->string('address_contact');
            $table->integer('head_id')->nullable();
            $table->integer('head_recommendation_status')->nullable();
            $table->date('head_recommendation_date')->nullable();
            $table->string('head_remarks')->nullable();
            $table->integer('ceo_id')->nullable();
            $table->integer('ceo_recommendation_status')->nullable();
            $table->date('ceo_recommendation_date')->nullable();
            $table->string('ceo_remarks')->nullable();
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
        Schema::dropIfExists('leave_applications');
    }
}
