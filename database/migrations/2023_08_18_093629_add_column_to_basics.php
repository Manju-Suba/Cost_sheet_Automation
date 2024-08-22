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
        Schema::table('basics', function (Blueprint $table) {
           $table->integer('b_quantity_approval')->after('quantity')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_mrp_price_approval')->after('mrp_price')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_retailer_margin_approval')->after('retailer_margin')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_primary_scheme_approval')->after('primary_scheme')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_rs_margin_approval')->after('rs_margin')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_ss_margin_approval')->after('ss_margin')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_specific_gravity_approval')->after('specific_gravity')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_total_rm_cost_approval')->after('total_rm_cost')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_conv_cost_approval')->after('conv_cost')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_salesTax_approval')->after('salesTax')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_damage_approval')->after('damage')->default(0)->description('0->default,1->approved,2->rejected');
           $table->integer('b_logistic_approval')->after('logistic')->default(0)->description('0->default,1->approved,2->rejected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basics', function (Blueprint $table) {
            //
        });
    }
};
