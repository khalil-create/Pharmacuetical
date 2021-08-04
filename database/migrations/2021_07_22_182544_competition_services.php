<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompetitionServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_services', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');//type of service, is money or physical (0 ==> money,1 ==> physical)
            $table->string('service_goal');
            $table->string('service_period');
            $table->string('source');
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
        Schema::dropIfExists('competition_services');
    }
}
