<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTemplates extends Migration {

    public function up() {

        Schema::table('orders_templates', function (Blueprint $table) {
            //
        });
    }


    public function down() {

        Schema::dropIfExists('orders_templates');
    }
}