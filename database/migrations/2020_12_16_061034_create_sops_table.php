<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('name',225)->nullable();
            $table->string('parent_id',225)->nullable();
            $table->string('issue_no',225)->nullable();
            $table->string('rev_no',225)->nullable();
            $table->string('doc_no',225)->nullable();
            $table->string('file',225)->nullable();
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
        Schema::dropIfExists('sops');
    }
}
