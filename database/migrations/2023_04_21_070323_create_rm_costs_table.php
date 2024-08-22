<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rm_costs', function (Blueprint $table) {
            $table->id();
            $table->string('Product_id');
            $table->string('Product_name');
            $table->string('Ingredient');
            $table->string('Icomposition');
            $table->float('scrap');
            $table->float('rate');
            $table->float('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rm_costs');
    }
};
