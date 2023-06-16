<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id');
            $table->bigInteger('product_id');
            $table->bigInteger('supplier_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('total_price');
            $table->text('serials')->nullable();
            $table->text('warranty')->nullable();
            $table->string('purchase_date');
            $table->string('expired_date')->nullable();
            $table->string('is_stocked');
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
        Schema::dropIfExists('purchase_products');
    }
}
