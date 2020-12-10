<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->string('payment_way');
            $table->string('name');
            $table->string('amount');
            $table->string('number');
            $table->date('date');
            $table->longText('remarks');
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
        Schema::dropIfExists('receiving_ledgers');
    }
}
