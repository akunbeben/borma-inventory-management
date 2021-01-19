<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_header', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_id');
            $table->unsignedBigInteger('stock_out_type_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('stock_out_status')->onDelete('cascade');
            $table->foreign('stock_out_type_id')->references('id')->on('stock_out_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_out_header');
    }
}
