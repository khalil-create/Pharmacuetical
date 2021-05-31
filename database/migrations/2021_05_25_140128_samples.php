<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Samples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->string('count');
            $table->unsignedInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->unsignedInteger('manager_id');
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
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
        Schema::dropIfExists('samples');
    }
}
