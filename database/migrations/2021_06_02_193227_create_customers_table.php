<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->string('owner_name');
            $table->string('owner_phone');
            $table->string('owner_tel');
            $table->tinyInteger('size');//حجم العميل
            $table->tinyInteger('loyalty');//ولاء العميل
            $table->string('name_sub_area');
            $table->boolean('statues');
            $table->string('contact_official_name');//اسم مسؤول الاتصال
            $table->string('contact_official_type');//الموقع الوظيفي لمسؤول الاتصال
            $table->string('contact_official_phone');//رقم الهاتف لمسؤول الاتصال
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
        Schema::dropIfExists('customers');
    }
}
