<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('gender', 200)->nullable();
            $table->date('birth')->nullable();
            $table->text('address')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('last_education', 100)->nullable();
            $table->string('institute_name', 100)->nullable();
            $table->string('majors', 100)->nullable();
            $table->string('graduate_year', 100)->nullable();
            $table->string('photo', 200)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('detail_users');
    }
}
