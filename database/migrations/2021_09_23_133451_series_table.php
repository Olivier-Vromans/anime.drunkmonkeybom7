<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table){
            $table->id();
            $table->string('title', 255);
            $table->string('description');
            $table->integer('genre_id');
            $table->integer('language_id');
            $table->integer('seasons');
            $table->integer('episodes');
            $table->integer('users_favorite');
            $table->integer('rating');
            $table->integer('year');
            $table->integer('comment_id');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
