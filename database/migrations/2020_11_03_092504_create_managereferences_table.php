<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagereferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managereferences', function (Blueprint $table) {
            $table->id();
            $table->integer('parameter');
            $table->integer('asset');
            $table->integer('unit');
            $table->string('uuc');
            $table->string('ref');
            $table->string('error');
            $table->string('uncertainty');
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
        Schema::dropIfExists('managereferences');
    }
}
