<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration {

    public function up() {

        if (!Schema::hasTable('medias')) {

            Schema::create('medias', function (Blueprint $table) {
                $table->increments('id');
                $table->string('file', 255);
                $table->integer('template_id')->unsigned();
                $table->enum('type', ['image', 'youtube']);
                $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down() {
        Schema::dropIfExists('medias');
    }
}