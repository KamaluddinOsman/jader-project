<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('client_id');
			$table->integer('city_id')->nullable();
			$table->string('name_responsible')->nullable();
			$table->string('responsible_position')->nullable();
			$table->string('responsible_mobile')->nullable();
			$table->string('name_authorized')->nullable();
			$table->string('authorized_mobile')->nullable();
			$table->string('logo')->nullable();
			$table->string('front_img')->nullable();
			$table->string('cover')->nullable();
			$table->string('name')->nullable();
			$table->string('legal_name')->nullable();
			$table->string('phone1');
			$table->string('phone2')->nullable();
			$table->string('company_register')->nullable();
			$table->string('num_tax')->nullable();
			$table->string('address');
			$table->string('lang')->nullable();
			$table->string('late')->nullable();
			$table->text('about')->nullable();
			$table->float('minimum_order')->nullable();
			$table->float('delivery_limit')->nullable();
			$table->boolean('delivery_service')->nullable();  //هل لديك توصيل
			$table->float('delivery_price')->nullable();
			$table->string('picture_contract')->nullable();
			$table->string('email')->nullable();
			$table->string('whatsapp')->nullable();
			$table->string('facebook')->nullable();
			$table->string('site')->nullable();
			$table->string('name_card')->nullable();
			$table->string('ipan')->nullable();
			$table->string('bank_name')->nullable();
			$table->time('start_time')->nullable();
			$table->time('end_time')->nullable();
			$table->string('order_processing_time')->nullable();
			$table->json('day_work')->nullable();
			$table->string('active')->default(0);      //0->معلق   // 1-> موافق // 2->الغاء//
			$table->boolean('status')->default(1); //0->مغلق // 1-> متاح // 2-> مشغول
			$table->string('ratio')->default(1); //1->عادى // 2-> صفرى // 3-> بلاتينى // 4->فضى // 5->ذهبى // 6->ماسى
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('stores');
	}
}
