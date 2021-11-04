<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned();
            $table->string('title')->nullable();
            $table->boolean('type')->nullable();  //1 متعدد    -- 2فردى
            $table->boolean('plus')->nullable();  //0 خصم    -- 1اضافة
            $table->boolean('status')->nullable();  //0 متوقف    -- 1شغال
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
        Schema::dropIfExists('product_attrs');
    }
}
