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
            $table->text('description')->nullable();
            $table->integer('episodes')->nullable();
            $table->integer('users_favorite')->nullable();
            $table->integer('rating')->nullable();
            $table->string('year')->nullable();
            $table->integer('comment_id')->nullable();
            $table->string('image_card')->nullable();
            $table->string('image_show')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
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
