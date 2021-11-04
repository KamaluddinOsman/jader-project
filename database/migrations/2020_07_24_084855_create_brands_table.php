<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration {

	public function up()
	{
		Schema::create('brands', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->nullable();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('brands');
	}
}