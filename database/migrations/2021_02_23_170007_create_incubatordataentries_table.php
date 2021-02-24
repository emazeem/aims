<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncubatordataentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incubatordataentries', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('x1')->nullable();
            $table->string('x2')->nullable();
            $table->string('x3')->nullable();
            $table->integer('asset_id');
            $table->integer('unit');
            $table->string('set_value')->nullable();
            $table->string('uuc_indication')->nullable();
            $table->string('data',10000)->nullable();
            $table->integer('channel');
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
        Schema::dropIfExists('incubatordataentries');
    }
}
