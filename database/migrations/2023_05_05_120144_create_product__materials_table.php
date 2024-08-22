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
        Schema::create('product__materials', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->string('product_details');
            $table->string('specification');
            $table->string('quantity');
            $table->string('MOQ');
            $table->string('vendor');
            $table->string('basic');
            $table->string('freight');
            $table->string('scrap');
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
        Schema::dropIfExists('product__materials');
    }
};
