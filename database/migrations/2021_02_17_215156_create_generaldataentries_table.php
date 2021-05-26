<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneraldataentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generaldataentries', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('x1')->nullable();
            $table->string('x2')->nullable();
            $table->string('x3')->nullable();
            $table->string('x4')->nullable();
            $table->string('x5')->nullable();
            $table->string('x6')->nullable();
            $table->integer('asset_id');
            $table->integer('unit');
            $table->string('fixed_value')->nullable();
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
        Schema::dropIfExists('generaldataentries');
    }
}
