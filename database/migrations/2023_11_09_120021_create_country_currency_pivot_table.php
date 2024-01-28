<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;
use App\Models\Currency;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country_currency', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->constrained()
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreignIdFor(Currency::class)->constrained()
                ->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_currency');
    }
};
