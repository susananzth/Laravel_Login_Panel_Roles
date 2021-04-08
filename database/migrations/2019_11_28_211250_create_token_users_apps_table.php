<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokenUsersAppsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_users_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tp_token')->default(null);
            $table->text('token_llave');
            $table->text('token_code');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_tp_token')->references('id')->on('tp_tokens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('token_users_apps');
    }
}
