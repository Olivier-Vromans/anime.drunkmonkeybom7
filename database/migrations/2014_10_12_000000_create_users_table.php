<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('role')->default(0); //0 = User, 1 = Admin
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('favorites');
            $table->string('profile_picture');
            $table->rememberToken();
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
    //
    }
}
