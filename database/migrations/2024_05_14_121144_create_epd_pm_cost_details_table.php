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
        Schema::create('epd_pm_cost_details', function (Blueprint $table) {
            $table->id();
            $table->string('epro_id',50);
            $table->string('plant',50);
            $table->string('in_mat_desc',250);
            $table->string('fin_mat_desc',250);
            $table->string('bom_qty',50);
            $table->string('meeht',25);
            $table->string('rate',25);
            $table->string('cost',25);
            $table->string('user_id',10);
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
        Schema::dropIfExists('epd_pm_cost_details');
    }
};
