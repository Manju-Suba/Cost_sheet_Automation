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
        Schema::create('epd_reject_histories', function (Blueprint $table) {
            $table->id();
            $table->string('epro_id',10);
            $table->string('column_name',50);
            $table->string('value',50);
            $table->string('remarks',250);
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
        Schema::dropIfExists('epd_reject_histories');
    }
};
