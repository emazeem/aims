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
            $table->string('indent_type');
            $table->string('location',225);
            $table->integer('deliver_to');
            $table->string('chargeable_to');
            $table->integer('department_id');
            $table->integer('store_incharge');
            $table->integer('selected_vendor')->nullable();
            $table->date('required');
            $table->integer('indenter');
            $table->integer('prepared_by');
            $table->integer('checked_by');
            $table->integer('approved_by');
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
        Schema::dropIfExists('purchaseindents');
    }
}
