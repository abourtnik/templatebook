<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::hasTable('likes')) {

            Schema::create('likes', function (Blueprint $table) {

                $table->increments('id');

                $table->integer('user_id')->unsigned();
                $table->integer('suggestion_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('likes');
    }
}
