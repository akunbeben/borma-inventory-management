<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('npk');
            $table->string('password');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
