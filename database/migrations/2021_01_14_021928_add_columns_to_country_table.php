<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {


            $table->integer('id_tp_money')->nullable()->after('status');
            $table->text('code_country')->unique()->after('status')->nullable();
            $table->text('code_phone')->unique()->nullable();
            $table->text('moneda_local')->nullable();
            $table->text('moneda_admitida')->nullable();
            $table->text('simbolo_local')->nullable();
            $table->text('simbolo_admitida')->nullable();
            $table->double('conversion_monto',10,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_tp_money')->references('id')->on('tp_money');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('id_tp_money');
            $table->dropColumn('code_country');
            $table->dropColumn('code_phone');
            $table->dropColumn('moneda_local');
            $table->dropColumn('moneda_admitida');
            $table->dropColumn('simbolo_local');
            $table->dropColumn('simbolo_admitida');
            $table->dropColumn('conversion_monto');
            $table->dropColumn('property');
        });
    }
}
