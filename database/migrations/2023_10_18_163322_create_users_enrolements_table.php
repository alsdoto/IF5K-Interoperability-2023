<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEnrolementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_enrolements', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('roles_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('users_enrolements');
    }
}
