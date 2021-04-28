<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseindentitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseindentitems', function (Blueprint $table) {
            $table->id();
            $table->integer('indent_id');
            $table->string('item_code');
            $table->string('item_description');
            $table->string('ref_code');
            $table->string('unit');
            $table->string('last_six_months_consumption');
            $table->integer('current_stock');
            $table->integer('qty');
            $table->string('purpose',1000);
            $table->string('title',225);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('purchaseindentitems');
    }
}
