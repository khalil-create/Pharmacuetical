<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_month');
            $table->date('plan_date');
            $table->boolean('plan_status');
            $table->integer('plan_progress');
            $table->unsignedInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('plan_types')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('representative_id')->unsigned();
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('plans');
    }
}
