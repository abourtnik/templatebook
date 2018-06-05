<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTemplate extends Migration {

    public function up() {

        if (!Schema::hasTable('order_template')) {

            Schema::create('order_template', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('order_id')->unsigned()->index();
                $table->integer('template_id')->unsigned()->index();
                $table->integer('quantity')->unsigned();

                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');

            });
        }
    }


    public function down() {

        Schema::dropIfExists('order_template');
    }
}