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
            $table->uuid('id')->primary();
            $table->string('product_plu');
            $table->string('product_name');
            $table->integer('product_initial_quantity');
            $table->dateTime('product_expired_date');
            $table->uuid('product_supplier')->nullable(true);
            $table->unsignedBigInteger('product_type');
            $table->string('product_package');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_supplier')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('product_type')->references('id')->on('product_types')->onDelete('cascade');
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
