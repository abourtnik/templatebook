<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

    public function up() {

        if (!Schema::hasTable('templates')) {

            Schema::create('templates', function (Blueprint $table) {

                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('source', 255);
                $table->float('price')->default(0.0);
                $table->smallInteger('downloads')->unsigned()->default(0);
                $table->smallInteger('views')->unsigned()->default(0);
                $table->integer('user_id')->unsigned();
                $table->integer('category_id')->unsigned()->nullable();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('category_id')->references('id')->on('categories');

                $table->timestamps();
            });
        }
    }
    
    public function down() {

        Schema::dropIfExists('templates');

    }
}