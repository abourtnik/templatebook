<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::hasTable('votes')) {

            Schema::create('votes', function (Blueprint $table) {

                $table->increments('id');

                $table->boolean('status');
                $table->integer('user_id')->unsigned();
                $table->integer('template_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('template_id')->references('id')->on('templates');

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

        Schema::dropIfExists('votes');
    }
}