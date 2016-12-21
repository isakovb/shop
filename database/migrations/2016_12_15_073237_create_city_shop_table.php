<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->integer('shop_id')->unsigned();
            $table->string('coord');
            $table->string('contacts');
            $table->string('schedule');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('city_shops');
    }
}
