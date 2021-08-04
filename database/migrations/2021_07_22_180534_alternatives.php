<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alternatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commercial_name');
            $table->string('agency_name');
            $table->string('company_name');
            $table->string('country_manufacturing');
            $table->string('unit');
            $table->string('refill');//العبوة
            $table->string('price');
            $table->string('bonus');
            $table->string('promotion_materials',500);
            $table->string('date');
            $table->unsignedInteger('competitor_id')->unsigned();
            $table->foreign('competitor_id')->references('id')->on('competitors')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('alternatives');
    }
}
