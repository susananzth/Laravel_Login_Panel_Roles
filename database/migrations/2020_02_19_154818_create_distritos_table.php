<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistritosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_city')->nullable()->default(null);
            $table->text('distrito');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_city')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('distritos');
    }
}
