<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table){
            $table->id();
            $table->string('title', 255);
            $table->string('description')->nullable();
            $table->integer('genre_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('seasons')->nullable();
            $table->integer('episodes')->nullable();
            $table->integer('users_favorite')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('year')->nullable();
            $table->integer('comment_id')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime');
    }
}
