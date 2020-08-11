<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->morphs('videoable');
//            $table->integer('post_id')->nullable();
//            $table->integer('event_id')->nullable();
//            $table->integer('training_id')->nullable();
            $table->string('file', 200);
            $table->string('file_type', 100)->nullable();
            $table->text('caption')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
