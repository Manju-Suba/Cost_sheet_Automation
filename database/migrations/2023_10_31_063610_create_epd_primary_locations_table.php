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
        Schema::create('epd_primary_locations', function (Blueprint $table) {
            $table->id();
            $table->string('pro_id');
            $table->string('from_location');
            $table->string('to_location');
            $table->string('retailer_margin');
            $table->string('primary_scheme');
            $table->string('rs_margin');
            $table->string('ss_margin');
            $table->string('freight');
            $table->string('p_cost_approval')->nullable();
            $table->string('freightuser');
            $table->timestamp('freightdate')->nullable();
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
        Schema::dropIfExists('epd_primary_locations');
    }
};
