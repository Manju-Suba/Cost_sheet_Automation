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
        Schema::table('product__materials', function (Blueprint $table) {
            $table->integer('p_quantity_approval')->after('quantity')->default(0)->description('0->default,1->approved,2->rejected');
            $table->integer('p_moq_approval')->after('moq')->default(0)->description('0->default,1->approved,2->rejected');
            $table->integer('p_scrap_approval')->after('scrap')->default(0)->description('0->default,1->approved,2->rejected');
            $table->integer('p_pm_cost_approval')->after('pm_cost')->default(0)->description('0->default,1->approved,2->rejected');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product__materials', function (Blueprint $table) {
            //
        });
    }
};
