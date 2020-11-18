<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capabilities', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->integer('parameter');
            $table->integer('procedure');
            $table->string('range',191);
            $table->integer('price');
            $table->string('accuracy',191);
            $table->string('unit',191)->nullable();
            $table->string('remarks',191);
            $table->string('location',191);
            $table->string('accredited',191);
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
        Schema::dropIfExists('capabilities');
    }
}
