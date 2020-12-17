<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreventivemaintenancerecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventivemaintenancerecords', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->string('checked');
            $table->string('unchecked');
            $table->longText('breakdown_description')->nullable();
            $table->longText('corrective_description')->nullable();
            $table->integer('performed_by');
            $table->integer('lab_in_charge');
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
        Schema::dropIfExists('preventivemaintenancerecords');
    }
}
