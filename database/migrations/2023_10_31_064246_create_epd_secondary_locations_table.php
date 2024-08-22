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
        Schema::create('epd_secondary_locations', function (Blueprint $table) {
            $table->id();
            $table->string('epro_id',25);
            $table->string('from_location',10);
            $table->string('to_location',10);
            $table->string('freight',10);
            $table->string('s_cost_approval',10)->nullable();
            $table->string('freightsuser',10);
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
        Schema::dropIfExists('epd_secondary_locations');
    }
};
