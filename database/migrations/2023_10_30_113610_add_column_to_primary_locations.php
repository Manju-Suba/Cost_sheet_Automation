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
        Schema::table('primary_locations', function (Blueprint $table) {
            $table->integer('freight_user')->after('cost')->nullable();
            $table->timestamp('freight_date')->nullable();

        });
        Schema::table('secondary_locations', function (Blueprint $table) {
            $table->integer('freight_user')->after('cost')->nullable();
            $table->timestamp('freight_date')->nullable();

        });
        Schema::table('basics', function (Blueprint $table) {
            $table->integer('tax_user')->after('salesTax')->nullable();
            $table->timestamp('tax_date')->nullable();
            $table->integer('logistic_user')->after('logistic')->nullable();
            $table->timestamp('logistic_date')->nullable();

        });
        Schema::table('product__materials', function (Blueprint $table) {
            $table->integer('package_user')->nullable();
            $table->string('uom')->after('quantity')->nullable();
            $table->integer('pm_user')->nullable();
            $table->timestamp('pm_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('primary_locations', function (Blueprint $table) {
            $table->dropColumn('freight_user');
            $table->dropColumn('freight_date');
        });
        Schema::table('secondary_locations', function (Blueprint $table) {
            $table->dropColumn('freight_user');
            $table->dropColumn('freight_date');
        });
        Schema::table('product__materials', function (Blueprint $table) {
            $table->dropColumn('package_user');
            $table->dropColumn('uom');
            $table->dropColumn('pm_user');
            $table->dropColumn('pm_date');
        });
        Schema::table('basics', function (Blueprint $table) {
            $table->dropColumn('tax_user');
            $table->dropColumn('tax_date');
            $table->dropColumn('logistic_user');
            $table->dropColumn('logistic_date');
        });

    }
};

