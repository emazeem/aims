<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labjobs', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->integer('job_id');
            $table->integer('item_id');
            $table->string('eq_id')->nullable();
            $table->string('serial')->nullable();
            $table->string('model')->nullable();
            $table->string('make')->nullable();
            $table->string('accessories')->nullable();
            $table->string('visual_inspection')->nullable();
            $table->integer('status')->default(0);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->integer('assign_user')->nullable();
            $table->string('assign_assets')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('labjobs');
    }
}
