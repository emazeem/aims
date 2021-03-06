<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccLevelFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_level_fours', function (Blueprint $table) {
            $table->id();

            $table->integer('code1');
            $table->integer('code2');
            $table->integer('code3');
            $table->char('code4',3);
            $table->char('acc_code',9);
            $table->string('title');
            $table->string('opening_balance')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('acc_level_fours');
    }
}
//ALTER TABLE `acc_level_fours` ADD `opening_balance` VARCHAR(225) NOT NULL DEFAULT '0' AFTER `title`;