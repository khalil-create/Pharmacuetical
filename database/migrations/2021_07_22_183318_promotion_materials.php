<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PromotionMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('targets');
            $table->string('image');
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
        Schema::dropIfExists('promotion_materials');
    }
}
