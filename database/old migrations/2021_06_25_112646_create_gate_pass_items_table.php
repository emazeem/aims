<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_pass_items', function (Blueprint $table) {
            $table->id();
            $table->integer('gp_id');
            $table->integer('item_id');
            $table->string('out_fcv')->nullable();
            $table->string('in_fcv')->nullable();
            $table->string('out_status')->nullable();
            $table->string('in_status')->nullable();
            $table->integer('out_fcb')->nullable();
            $table->integer('in_fcb')->nullable();
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
        Schema::dropIfExists('gate_pass_items');
    }
}
