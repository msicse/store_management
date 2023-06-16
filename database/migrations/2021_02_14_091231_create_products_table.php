<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('producttype_id');
            $table->integer('type');
            $table->string('title');
            $table->string('slug');
            $table->string('model')->nullable();
            $table->string('unit')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            //$table->foreign('producttype_id')->references('id')->on('producttypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
