<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('car_id')->unsigned()->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->double('client_money', 10, 2);
            $table->double('site_money', 10, 2)->nullable();
            $table->double('total_money', 10, 2);
                                          // ايداع         سحب       ارباح         مرتجع
            $table->enum('status',['bounced_back', 'commission', 'pull', 'remittance']);

            $table->string('note')->nullable();
            $table->string('transfer_Number')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('money_accounts');
    }
}
