<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_indent_id');
            $table->string('vendor');
            $table->string('quotation')->nullable();
            $table->string('quotation_ref')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('purchase_vendors');
    }
}
