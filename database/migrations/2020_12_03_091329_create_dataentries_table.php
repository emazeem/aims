<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataentries', function (Blueprint $table) {

            $table->id();
            $table->string('job_type')->nullable();
            $table->integer('asset_id')->nullable();
            $table->integer('job_type_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('start_temp')->nullable();
            $table->string('end_temp')->nullable();
            $table->string('location')->nullable();
            $table->string('fixed_type')->nullable();
            $table->string('before_offset')->nullable();
            $table->string('after_offset')->nullable();
            $table->integer('calibrated_by')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('x1')->nullable();
            $table->string('x2')->nullable();
            $table->string('x3')->nullable();
            $table->string('x4')->nullable();
            $table->string('x5')->nullable();
            $table->string('x6')->nullable();
            $table->string('fixed_value')->nullable();
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
        Schema::dropIfExists('dataentries');
    }
}
