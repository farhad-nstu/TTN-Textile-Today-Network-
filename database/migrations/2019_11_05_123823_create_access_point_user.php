<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessPointUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_point_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('access_point_id');
            $table->bigInteger('user_id');
            $table->dateTime('access_starts_at');
            $table->dateTime('access_ends_at');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('access_point_user');
    }
}
