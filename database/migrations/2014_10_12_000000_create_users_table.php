<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('user_fname');
            $table->string('user_lname');
            $table->string('user_email')->unique();
            $table->string('user_slug')->nullable();
            $table->text('user_pwd');
            $table->string('user_mobile',45)->nullable();
            $table->text('user_address')->nullable();
            $table->string('user_country',45)->nullable();
            $table->string('user_state',45)->nullable();
            $table->string('user_city',45)->nullable();
            $table->string('user_zip',45)->nullable();
            $table->boolean('user_status')->default('0');
            $table->integer('user_accesslevel')->default('1');
            $table->integer('user_delete')->default('0'); //check whether the user is blocked or not
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
