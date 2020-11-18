<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('code',191)->nullable()->unique();
            $table->integer('parameter');
            $table->string('make',191);
            $table->string('model',191);
            $table->string('range',191);
            $table->string('resolution',191);
            $table->integer('status');
            $table->string('accuracy',191);
            $table->date('next_due');
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
        Schema::dropIfExists('assets');
    }
}
