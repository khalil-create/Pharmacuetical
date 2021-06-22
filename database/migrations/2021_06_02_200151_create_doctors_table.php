<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('mobile_phone');
            $table->string('clinic_phone');
            $table->string('workplace_am');//مكان العمل في الفترة المسائية
            $table->string('workplace_pm');//مكان العمل في الفترة الصباحية
            // $table->tinyInteger('size');//حجم العميل
            $table->tinyInteger('loyalty');//الولاء للمؤسسة
            $table->string('rank');//الرتبه
            $table->string('address');
            $table->boolean('statues');
            $table->unsignedInteger('representative_id')->unsigned();
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
        Schema::dropIfExists('doctors');
    }
}
