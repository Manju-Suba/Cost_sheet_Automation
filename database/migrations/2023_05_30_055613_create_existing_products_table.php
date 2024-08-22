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
        Schema::create('existing_products', function (Blueprint $table) {
            $table->id();
            $table->string('epro_id',20);
            $table->string('material_code',50);
            $table->string('pieces_per_case',10);
            $table->string('noofpcs_approval',20);
            $table->string('mrp_piece',10);
            // $table->string('mrp_pcs_approval',20);
            $table->string('salesTax',5);
            $table->string('hsnCode',10);
            $table->string('tax_approval',20)->nullable();
            $table->string('taxuser',10);
            $table->timestamp('taxdate')->nullable();
            $table->string('damage',10);
            $table->string('damage_approval',20)->nullable();
            $table->string('logistic',10);
            $table->string('logistic_approval',20)->nullable();
            $table->string('damageuser',10);
            $table->timestamp('damagedate')->nullable();
            $table->string('status');
            $table->string('mt_exsheet_approval',20);
            $table->string('excsheet_approval',20);
            $table->string('marketuser');
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
        Schema::dropIfExists('existing_products');
    }
};
