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
        Schema::table('primary_locations', function (Blueprint $table) {
            $table->integer('p_cost_approval')->after('cost')->default(0)->description('0->default,1->approved,2->rejected');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('primary_locations', function (Blueprint $table) {
            //
        });
    }
};
