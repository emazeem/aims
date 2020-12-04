<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
            $table->integer('status')->default(0);
            $table->string('url')->default('#');
            $table->integer('position')->default(0);
            $table->string('parent_id')->nullable();
            $table->integer('has_child')->comment('parent_id=[0,1] if zero no dropdown and if one then show dropdown. if has child checked for child entries then show in nav');
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
        Schema::dropIfExists('menus');
    }
}
