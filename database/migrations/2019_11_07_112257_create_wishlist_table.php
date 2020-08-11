<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->morphs('wishlistable');
            $table->dateTime('wished_at');
//            $table->integer('job_id')->nullable();
//            $table->integer('training_id')->nullable();
//            $table->integer('event_id')->nullable();
//            $table->integer('post_id')->nullable();
//            $table->integer('mentor_id')->nullable();
//            $table->integer('question_id')->nullable();
//            $table->integer('classified_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlist');
    }
}
