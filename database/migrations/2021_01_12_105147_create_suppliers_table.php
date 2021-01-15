<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('supplier_code');
            $table->string('supplier_name');
            $table->text('supplier_address');
            $table->string('supplier_telephone');
            $table->uuid('created_by')->nullable(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('administrators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
