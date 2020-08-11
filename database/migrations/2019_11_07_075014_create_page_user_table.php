<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('is_creator');
            $table->tinyInteger('is_liked')->default('0');
            $table->tinyInteger('is_following')->default('0');
            $table->dateTime('liked_at')->nullable();
            $table->dateTime('following_from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_user');
    }
}
