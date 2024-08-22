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
        Schema::create('med_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pro_id');
            $table->string('product_name');
            $table->string('version');
            $table->string('amount');
            $table->string('remarks');
            $table->string('approve_status');
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
        Schema::dropIfExists('med_requests');
    }
};
