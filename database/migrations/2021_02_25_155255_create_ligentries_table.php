<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligentries', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('x1')->nullable();
            $table->string('x2')->nullable();
            $table->string('uuc')->nullable();
            $table->string('noofdiv')->nullable();
            $table->string('k_value')->nullable();
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
        Schema::dropIfExists('ligentries');
    }
}
