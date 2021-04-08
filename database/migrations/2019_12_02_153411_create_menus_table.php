<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->text('menu')->nullable();
            $table->text('section')->nullable();
            $table->text('path')->nullable();
            $table->integer('orden')->nullable();
            $table->text('icon')->nullable();
            $table->boolean('status_system')->default(true);
            $table->boolean('status_user')->default(true);
            $table->integer('modified_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
