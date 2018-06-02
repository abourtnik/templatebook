<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTemplates extends Migration {

    public function up() {

        Schema::create('orders_templates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->integer('template_id')->unsigned();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('template_id')->references('id')->on('templates');

        });
    }


    public function down() {

        Schema::dropIfExists('orders_templates');
    }
}