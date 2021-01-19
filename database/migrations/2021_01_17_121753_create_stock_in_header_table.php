<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in_header', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_id');
            $table->unsignedBigInteger('stock_in_type_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('stock_in_status')->onDelete('cascade');
            $table->foreign('stock_in_type_id')->references('id')->on('stock_in_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_in_header');
    }
}
