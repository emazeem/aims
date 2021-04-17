<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massreferences', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('density');
            $table->string('expanded_uncertainty');
            $table->string('volume');
            $table->string('gradient_temp');
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
        Schema::dropIfExists('massreferences');
    }
}
