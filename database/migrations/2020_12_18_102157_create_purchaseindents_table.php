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
            $table->integer('department_id');
            $table->integer('incharge_store');
            $table->string('chargeable_to');
            $table->string('indent_type');
            $table->integer('deliver_to');
            $table->integer('selected_vendor')->nullable();
            $table->integer('status');
            $table->date('required');
            $table->integer('indenter');
            $table->integer('prepared_by');
            $table->integer('checked_by');
            $table->integer('approved_by');
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
