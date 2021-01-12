<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_designation');
            $table->longText('reason');
            $table->string('qualification');
            $table->string('special_skills')->nullable();
            $table->integer('initiated_by');
            $table->string('time_frame');
            $table->string('hrd_review');
            $table->integer('approved_by')->nullable();
            $table->longText('remarks');
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
        Schema::dropIfExists('requisitions');
    }
}
