<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepresentativesTrainingCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives_training_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trainingCourse_id');
            $table->foreign('trainingCourse_id')->references('id')->on('training_courses')->onDelete('cascade');
            $table->unsignedInteger('representative_id');
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade');
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
        Schema::dropIfExists('representarives_tests');
    }
}
