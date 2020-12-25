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
            $table->date('reviewed_on')->nullable();
            $table->integer('reviewed_by')->nullable();
            $table->integer('status')->nullable();
            $table->string('location')->nullable();
            $table->string('mode_of_storage')->nullable();
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
