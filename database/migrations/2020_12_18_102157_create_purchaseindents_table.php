<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseindentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseindents', function (Blueprint $table) {
            $table->id();
            $table->string('location',225);
            $table->integer('department');
            $table->integer('indent_by');
            $table->integer('checked_by');
            $table->integer('approved_by');
            $table->string('indent_type');
            $table->string('deliver_to');
            $table->integer('status');
            $table->date('required');
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
        Schema::dropIfExists('purchaseindents');
    }
}
