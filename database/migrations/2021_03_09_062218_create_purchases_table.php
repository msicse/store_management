<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id');
            // $table->string('quantity');
            // $table->float('unite_price');
            $table->double('total_price');
            $table->string('invoice_no');
            $table->string('reference_invoice');
            $table->string('purchase_date');
            $table->tinyInteger('is_stocked');
            $table->timestamps();

           // $table->foreign('product_id')->references('id')->on('products');
           // $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
