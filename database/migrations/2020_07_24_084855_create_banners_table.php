<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration {

	public function up()
	{
		Schema::create('banners', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('banners');
	}
}
