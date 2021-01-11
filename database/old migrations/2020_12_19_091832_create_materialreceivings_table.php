<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialreceivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialreceivings', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_indent_item_id');
            $table->string('received_from');
            $table->string('purchase_type');
            $table->integer('physical_check');
            $table->integer('meet_specifications');
            $table->string('unit');
            $table->integer('qty');
            $table->string('specifications');
            $table->integer('status');
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
        Schema::dropIfExists('materialreceivings');
    }
}
