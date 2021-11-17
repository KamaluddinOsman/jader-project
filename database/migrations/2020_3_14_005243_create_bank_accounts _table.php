<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('credit_card_num')->nullable();
            $table->string('ipan')->nullable();
            $table->year('year')->nullable();
            $table->string('month')->nullable();
            $table->string('nameCard')->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
