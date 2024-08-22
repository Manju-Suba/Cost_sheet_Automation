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
        Schema::table('existing_products', function (Blueprint $table) {
            $table->string('material_type',220)->nullable();
            $table->string('material_name',220)->nullable();
            $table->string('fill_volume',20)->nullable();
            $table->string('plant',20)->nullable();
            $table->string('rmcost',50)->nullable();
            $table->string('rmscrap',50)->nullable();
            $table->string('pmcost',50)->nullable();
            $table->string('pmscrap',50)->nullable();
            $table->string('conv_cost',50)->nullable();
            $table->string('mrp',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('existing_products', function (Blueprint $table) {
            //
        });
    }
};
