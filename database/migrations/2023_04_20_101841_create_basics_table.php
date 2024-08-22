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
        Schema::create('basics', function (Blueprint $table) {
            $table->id();
            $table->string('Product_name');
            $table->integer('Volume');
            $table->string('uom');
            $table->integer('case_configuration');
            $table->integer('quantity');
            $table->integer('mrp_price');
            $table->string('from_location');
            $table->string('to_location');
            $table->integer('retailer_margin');
            $table->integer('primary_scheme');
            $table->integer('rs_margin');
            $table->integer('ss_margin');
            $table->string('specific_gravity');
            $table->string('total_rm_cost');
            $table->string('conv_cost');
            $table->string('conv_uom');
            $table->string('salesTax');
            $table->string('hsnCode');
            $table->string('primary_freight');
            $table->string('secondary_freight');
            $table->string('hsnCode');
            $table->string('status');
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
        Schema::dropIfExists('basics');
    }
};
