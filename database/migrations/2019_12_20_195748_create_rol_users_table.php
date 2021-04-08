<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->default(null);
            $table->integer('id_tp_rol')->default(null);
            $table->boolean('status')->default(true)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tp_rol')->references('id')->on('tp_rols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rol_users');
    }
}
