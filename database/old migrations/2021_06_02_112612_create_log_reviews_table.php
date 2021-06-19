<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('attachment');
            $table->integer('status')->default(0);
            $table->integer('priority');
            $table->integer('assign_to');
            $table->integer('created_by');
            $table->date('start');
            $table->date('end');
            $table->dateTime('started')->nullable();
            $table->dateTime('ended')->nullable();
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
        Schema::dropIfExists('log_reviews');
    }
}
