<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in_body', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('header_id');
            $table->uuid('product_id');
            $table->integer('quantity');
            $table->timestamp('expired_date');
            $table->timestamp('date_stock_in')->useCurrent();
            $table->text('information');
            $table->timestamps();

            $table->foreign('header_id')->references('id')->on('stock_in_header')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_in_body');
    }
}
