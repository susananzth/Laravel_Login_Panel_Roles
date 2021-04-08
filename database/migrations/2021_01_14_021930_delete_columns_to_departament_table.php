<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsToCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('departaments', 'created_at'))
        {
            Schema::table('departaments', function (Blueprint $table)
        {
           $table->dropColumn('created_at');
        });
        }
        if (Schema::hasColumn('departaments', 'updated_at'))
        {
            Schema::table('departaments', function (Blueprint $table)
        {
          $table->dropColumn('updated_at');
        });
        }
        if (Schema::hasColumn('departaments', 'deleted_at'))
        {
            Schema::table('departaments', function (Blueprint $table)
        {
         $table->dropColumn('deleted_at');
        });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
