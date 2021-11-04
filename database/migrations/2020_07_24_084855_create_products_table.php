<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('Products', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->integer('spacialCategory_id');
			$table->integer('brands_id');
			$table->string('name');
			$table->integer('rate');
			$table->float('price');
			$table->integer('code');
			$table->integer('quantity');
			$table->integer('rest_quantity');
			$table->string('image1');
			$table->string('image2')->nullable();
			$table->string('image3')->nullable();
			$table->string('image4')->nullable();
			$table->string('calories')->nullable();
			$table->text('notes')->nullable();
			$table->enum('type', array(0, 1));
			$table->string('status')->default(0);  //0 - مراجعه  1 - موافقه 2- مرفوض  4- ايقاف من المنشأه
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Products');
	}
}
