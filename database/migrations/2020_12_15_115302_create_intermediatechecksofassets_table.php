<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntermediatechecksofassetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intermediatechecksofassets', function (Blueprint $table) {
            $table->id();
            $table->integer('equipment_under_test_id')->nullable();
            $table->integer('check_reference_id')->nullable();
            $table->string('reference_value')->nullable();
            $table->longText('measured_value')->nullable();
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
        Schema::dropIfExists('intermediatechecksofassets');
    }
}
