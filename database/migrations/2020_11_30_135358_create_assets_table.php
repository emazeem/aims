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
            $table->string('name',225);
            $table->string('code',225)->unique();
            $table->integer('parameter');
            $table->integer('group_id');
            $table->string('make',225);
            $table->string('model',225);
            $table->string('range',225);
            $table->string('resolution',225);
            $table->integer('status')->default(0);
            $table->string('accuracy',225);
            $table->string('certificate_no',225);
            $table->string('serial_no',225);
            $table->string('traceability',225);
            $table->string('location',225);
            $table->string('image',225)->nullable();
            $table->date('due');
            $table->integer('calibration_interval');
            $table->date('commissioned');
            $table->date('calibration');
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
        Schema::dropIfExists('assets');
    }
}
