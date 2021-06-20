<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_title');
            $table->string('description');
            //This column store tow things either Tasking by write text or upload file pdf(store just file name)   
            $table->string('report_task',500)->nullable();
            $table->tinyInteger('performed');// 1 For was performed this task and 0 not perform yet
            $table->date('last_date');
            $table->unsignedInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedInteger('representative_id')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
