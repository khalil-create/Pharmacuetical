<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name_third');//الاسم الثلاثي
            $table->string('user_surname');//اللقب
            $table->string('user_type');
            $table->string('sex');
            $table->date('birthdate');
            $table->string('birthplace');//المحافظه
            $table->string('town');//المديرية
            $table->string('village');//العزلة
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('identity_type');//نوع الهوية
            $table->string('identity_number');//نوع الهوية
            $table->binary('user_image')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
