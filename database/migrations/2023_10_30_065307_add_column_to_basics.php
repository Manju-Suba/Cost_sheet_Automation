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
            $table->integer('marketuser')->after('version')->nullable();
        });
        Schema::table('primary_locations', function (Blueprint $table) {
            $table->string('retailer_margin',20)->after('cost')->nullable();
            $table->string('rs_margin',20)->after('retailer_margin')->nullable();
            $table->string('ss_margin',20)->after('rs_margin')->nullable();
            $table->string('primary_scheme',20)->after('ss_margin')->nullable();
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
        Schema::table('secondary_locations', function (Blueprint $table) {

        });
    }
};
