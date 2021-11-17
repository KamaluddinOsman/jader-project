<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarsTable extends Migration {

	public function up()
	{
		Schema::create('cars', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('Type_car');  // صغيره سيدان -- بكب صغيره -- بكب كبيره -- دينا -- سطحه -- شاحنة -- قلاب
			$table->integer('number')->nullable();
			$table->string('driver_license')->nullable();
			$table->string('personal_image')->nullable();
			$table->string('car_license')->nullable();
			$table->string('personal_id')->nullable();
			$table->string('car_model')->nullable();
			$table->string('image_car_front')->nullable();
			$table->string('image_car_back')->nullable();
			$table->integer('brand_id')->nullable();
			$table->string('activated')->nullable();  //0->معلق   // 1-> موافق // 2->الغاء//
			$table->string('char_car')->nullable();
			$table->string('stc_pay')->nullable();
			$table->string('bank_name')->nullable();
            $table->string('name_card')->nullable();
            $table->string('ipan')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('transfer_method')->nullable();
            $table->double('lang')->nullable();
			$table->double('late')->nullable();
            $table->boolean('status')->default(1); //0->غير متاح // 1-> متاح // 2-> مشغول
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cars');
	}
}
