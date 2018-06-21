<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::hasTable('suggestions')) {

            Schema::create('suggestions', function (Blueprint $table) {

                $table->increments('id');

                $table->integer('user_id')->unsigned();
                $table->text('content');

                $table->foreign('user_id')->references('id')->on('users');

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::dropIfExists('suggestions');
    }
}
