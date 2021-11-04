<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientOfferTable extends Migration {

	public function up()
	{
        Schema::create('client_offer', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->integer('offer_id')->unsigned();
//            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('client_offer');
	}
}
