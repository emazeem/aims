<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('type',225)->nullable();
            $table->string('rfq_mode',225)->nullable();
            $table->string('rfq_mode_details',225)->nullable();
            $table->string('approval_mode',225)->nullable();
            $table->string('approval_mode_details',225)->nullable();
            $table->date('approval_date')->nullable();
            $table->integer('status')->default(0);
            $table->string('turnaround');
            $table->string('remarks')->nullable();
            $table->integer('tm')->nullable();
            $table->string('principal')->nullable();
            $table->integer('revision')->default(0);
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
        Schema::dropIfExists('quotes');
    }
}
