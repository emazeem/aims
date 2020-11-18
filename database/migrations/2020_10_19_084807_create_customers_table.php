<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->string('reg_name',191);
            $table->string('ntn');
            $table->string('region');
            $table->string('address',1000);
            $table->integer('credit_limit');
            $table->string('customer_type',191);
            $table->string('pay_terms',191);
            $table->string('prin_name_1',191);
            $table->string('prin_phone_1',191);
            $table->string('prin_email_1',191);

            $table->string('prin_name_2',191)->nullable();
            $table->string('prin_phone_2',191)->nullable();
            $table->string('prin_email_2',191)->nullable();

            $table->string('prin_name_3',191)->nullable();
            $table->string('prin_phone_3',191)->nullable();
            $table->string('prin_email_3',191)->nullable();

            $table->string('pur_name',191)->nullable();
            $table->string('pur_phone',191)->nullable();
            $table->string('pur_email',191)->nullable();
            $table->string('acc_name',191)->nullable();
            $table->string('acc_phone',191)->nullable();
            $table->string('acc_email',191)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
