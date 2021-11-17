<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
            $table->morphs('notifiable');
            $table->uuid('id')->primary();
            $table->integer('order_id');
			$table->string('title');
			$table->string('body');
			$table->string('type');

            $table->text('data');
            $table->timestamp('read_at')->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
