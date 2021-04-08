<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersAppsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tp_sexo')->nullable();
            $table->integer('id_country')->nullable();
            $table->integer('id_departament')->nullable();
            $table->integer('id_city')->nullable();
            $table->text('nombres')->nullable();
            $table->text('apellidos')->nullable();
            $table->date('f_nacimiento')->nullable();
            $table->text('telefono')->unique()->nullable();
            $table->text('email')->unique()->nullable();
            $table->integer('id_status_users_app')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_tp_sexo')->references('id')->on('tp_sexos');
            $table->foreign('id_country')->references('id')->on('countries');
            $table->foreign('id_departament')->references('id')->on('departaments');
            $table->foreign('id_city')->references('id')->on('cities');
            $table->foreign('id_status_users_app')->references('id')->on('status_users_apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_apps');
    }
}
