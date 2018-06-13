<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowerTable extends Migration
{
    public function up() {

        if (!Schema::hasTable('followers')) {

            Schema::create('followers', function (Blueprint $table) {

                $table->increments('id');

                $table->integer('user_id')->unsigned();
                $table->integer('follower_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('follower_id')->references('id')->on('users');

                $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('followers');
    }
}
