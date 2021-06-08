<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepresentativesSubareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives_subareas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subarea_id');
            $table->foreign('subarea_id')->references('id')->on('subareas');
            $table->unsignedInteger('representative_id');
            $table->foreign('representative_id')->references('id')->on('representatives')->onUpdate('cascade');
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
        Schema::dropIfExists('representatives_subareas');
    }
}
