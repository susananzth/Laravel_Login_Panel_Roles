<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_documents', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_users_app')->default(null);
          $table->text('url_photo_front');
          $table->text('url_photo_post');
          $table->boolean('status')->default(true);
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
        Schema::dropIfExists('photo_documents');
    }
}
