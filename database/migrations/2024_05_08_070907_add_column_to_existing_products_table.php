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
        Schema::table('existing_products', function (Blueprint $table) {
            $table->string('division',20);
            $table->string('specific_gravity',10)->default(0);
            $table->string('gravity_approval',10)->default('pending');
            $table->string('gravity_user',10)->nullable();
            $table->timestamp('gravity_date')->nullable();
            $table->string('rmcost_verified',20)->default('not yet');
            $table->string('pmcost_verified',20)->default('not yet');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('existing_products', function (Blueprint $table) {
            //
        });
    }
};
