<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('imagable');
//            $table->bigInteger('post_id')->nullable();
//            $table->bigInteger('event_id')->nullable();
//            $table->bigInteger('training_id')->nullable();
//            $table->bigInteger('user_id')->nullable();
//            $table->bigInteger('comment_id')->nullable();
//            $table->bigInteger('app_id')->nullable();
//            $table->bigInteger('page_id')->nullable();
//            $table->bigInteger('group_id')->nullable();
//            $table->bigInteger('classified_id')->nullable();
            $table->string('image',100);
            $table->text('caption');
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
        Schema::dropIfExists('images');
    }
}
