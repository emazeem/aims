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
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('code');
            $table->string('title');
            $table->string('model');
            $table->string('description');
            $table->string('item_type')->comment('consumable,fixed asset etc');
            $table->string('purpose',1000);
            $table->string('unit');
            $table->string('ref_doc');
            $table->string('consumption_6months');
            $table->float('price');
            $table->integer('qty');
            $table->integer('receiving_qty');
            $table->integer('status')->default(0);
            $table->integer('inventory_id')->nullable();
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
