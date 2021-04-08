<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRedUsuariosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('red_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users_sponsor')->default(null)->nullable();
            $table->integer('id_users_invitado')->default(null)->unique();
            $table->text('codigo_invitado')->unique();
            $table->text('usuario_invitado')->nullable()->unique();
            $table->integer('id_status_red')->default(null);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_users_sponsor')->references('id')->on('users_apps');
            $table->foreign('id_users_invitado')->references('id')->on('users_apps');
            $table->foreign('id_status_red')->references('id')->on('status_reds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('red_usuarios');
    }
}
