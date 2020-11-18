<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicingLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicing_ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('customer_id');
            $table->integer('service_charges');
            $table->string('service_tax_type')->comment('PRA SRB etc');
            $table->string('service_tax_percent');
            $table->integer('service_tax_amount');
            $table->integer('income_tax_percent')->comment('SRO budget like 3%');
            $table->integer('income_tax_amount');
            $table->string('service_tax_deducted')->comment('by aims or at source');
            $table->string('income_tax_deducted')->comment('by aims or at source');
            $table->integer('net_receivable');
            $table->integer('srb_type')->nullable()->comment('0 if pays 100% 20% if he pays 80%');
            $table->string('confirmed_by_name')->comment('invoice confirmed by');
            $table->string('confirmed_by_phone');
            $table->date('invoice');
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
        Schema::dropIfExists('invoicing_ledgers');
    }
}
