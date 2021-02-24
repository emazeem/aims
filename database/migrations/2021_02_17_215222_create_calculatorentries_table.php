<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatorentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculatorentries', function (Blueprint $table) {
            $table->id();
/*            $table->string('calculator')->nullable();
            $table->integer('asset_id')->nullable();*/
            $table->integer('job_type_id')->nullable();
/*            $table->string('unit')->nullable();*/
            $table->integer('asset_id')->nullable();
            $table->string('start_temp')->nullable();
            $table->string('end_temp')->nullable();
            $table->string('start_humidity')->nullable();
            $table->string('end_humidity')->nullable();
            $table->string('location')->nullable();
            //for general only
            $table->string('fixed_type')->nullable();
            $table->string('before_offset')->nullable();
            $table->string('after_offset')->nullable();
            //for balance only
            $table->string('start_atmospheric_pressure')->nullable();
            $table->string('end_atmospheric_pressure')->nullable();
            $table->string('pan_position')->nullable();
            $table->string('repeatability')->nullable();
            $table->string('uuc_temp')->nullable();
            $table->string('ref_temp')->nullable();
            //end for balance only
            $table->integer('calibrated_by')->nullable();
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
        Schema::dropIfExists('calculatorentries');
    }
}
