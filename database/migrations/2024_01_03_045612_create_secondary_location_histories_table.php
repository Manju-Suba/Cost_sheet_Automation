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
        Schema::create('secondary_location_histories', function (Blueprint $table) {
             $table->id();
            $table->string('location_id');
            $table->string('product_id');
            $table->string('cost');
            $table->string('description',255);
            $table->string('remarks',255);
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
        Schema::dropIfExists('secondary_location_histories');
    }
};
