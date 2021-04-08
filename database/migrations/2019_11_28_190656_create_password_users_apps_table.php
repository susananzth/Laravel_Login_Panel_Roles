<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordUsersAppsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_users_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users_app')->default(null);
            $table->text('password');
            $table->text('password_repeat');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_users_app')->references('id')->on('users_apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_users_apps');
    }
}
