<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration {

    public function up() {

        if (!Schema::hasTable('categories')) {

            Schema::create('categories', function (Blueprint $table) {

                $table->increments('id');

                $table->string('name')->unique();
                $table->text('description');
                $table->string('image');

            });
        }
    }

    public function down() {
        Schema::dropIfExists('categories');
    }
}