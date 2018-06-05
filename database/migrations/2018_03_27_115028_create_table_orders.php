<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration {

    public function up() {

        if (!Schema::hasTable('orders')) {

            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users');
                $table->float('ammount');
                $table->string('paypal_id')->unique();
                $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }

    public function down() {

        Schema::dropIfExists('order_template');
        Schema::dropIfExists('orders');
    }
}