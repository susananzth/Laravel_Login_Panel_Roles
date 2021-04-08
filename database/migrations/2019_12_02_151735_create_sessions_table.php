<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('token');
            $table->date('d_inicio');
            $table->time('h_inicio');
            $table->date('d_fin')->nullable();
            $table->time('h_fin')->nullable();
            $table->text('ip')->nullable();
            $table->text('navegador')->nullable();
            $table->integer('id_status_session')->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_status_session')->references('id')->on('status_sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sessions');
    }
}
