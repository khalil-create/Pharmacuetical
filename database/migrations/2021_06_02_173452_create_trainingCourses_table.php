<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('important_points');//upload file (pdf-ppt-word or link video on youtube)
            $table->unsignedInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('training_courses');
    }
}
