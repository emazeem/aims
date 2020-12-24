<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsandformatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formsandformats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('sops')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('rev_no')->nullable();
            $table->string('issue_no')->nullable();
            $table->string('file')->nullable();
            $table->date('issue')->nullable();
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
        Schema::dropIfExists('formsandformats');
    }
}
