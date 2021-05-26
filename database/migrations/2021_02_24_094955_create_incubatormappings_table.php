<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncubatormappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incubatormappings', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('time_interval');
            $table->string('channel_1');
            $table->string('channel_2');
            $table->string('channel_3');
            $table->string('channel_4');
            $table->string('channel_5');
            $table->string('channel_6');
            $table->string('channel_7');
            $table->string('channel_8');
            $table->string('channel_9');
            $table->string('channel_10');
            $table->string('uuc_reading');
            $table->string('data',2000)->nullable();
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
        Schema::dropIfExists('incubatormappings');
    }
}
