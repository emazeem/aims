<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVernierentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vernierentries', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id');
            $table->string('x1');
            $table->string('x2');
            $table->string('x3');
            $table->string('ref');
            $table->integer('asset_id');
            $table->integer('unit');
            $table->string('data',10000)->nullable();
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
        Schema::dropIfExists('vernierentries');
    }
}
