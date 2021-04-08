<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolMenusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu')->default(null);
            $table->integer('id_tp_rol')->default(null);
            $table->text('note')->nullable();
            $table->boolean('status_system')->default(true);
            $table->boolean('status_user')->default(true);
            $table->integer('modified_by')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_tp_rol')->references('id')->on('tp_rols');
            $table->foreign('id_menu')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rol_menus');
    }
}
