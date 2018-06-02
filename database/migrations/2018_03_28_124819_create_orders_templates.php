<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTemplates extends Migration {

    public function up() {

        Schema::create('order_template', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('order_id')->unsigned()->index();
            $table->integer('template_id')->unsigned()->index();
            $table->integer('quantity')->unsigned();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('template_id')->references('id')->on('templates');

        });
    }
    public function down() {
        
        Schema::dropIfExists('orders_templates');
    }
}