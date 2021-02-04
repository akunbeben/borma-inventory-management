<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('document_number');
            $table->unsignedBigInteger('document_type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('created_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('document_type_id')->references('id')->on('document_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
