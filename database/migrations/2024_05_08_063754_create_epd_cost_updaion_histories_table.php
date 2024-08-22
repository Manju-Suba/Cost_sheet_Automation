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
        Schema::create('epd_cost_updaion_histories', function (Blueprint $table) {
            $table->id();
            $table->string('epd_id',20);
            $table->string('cost_type',25);
            $table->string('previous_cost',25);
            $table->string('created_by',50);
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
        Schema::dropIfExists('epd_cost_updaion_histories');
    }
};
