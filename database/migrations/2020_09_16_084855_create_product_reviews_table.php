<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductReviewsTable extends Migration {

	public function up()
	{
        Schema::create('product_reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('product_reviews');
	}
}
