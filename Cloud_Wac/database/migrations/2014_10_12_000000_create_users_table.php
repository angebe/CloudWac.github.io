<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username', 60)->unique();
            $table->string('name', 60);
            $table->string('lastname', 60);
            $table->date('birthdate');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->string('activation_code');
            $table->integer('active')->default(0);
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
        Schema::drop('users');
    }
}
