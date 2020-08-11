<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->morphs('commentable');
//            $table->bigInteger('post_id')->nullable();
//            $table->bigInteger('event_id')->nullable();
//            $table->bigInteger('training_id')->nullable();
//            $table->bigInteger('job_id')->nullable();
//            $table->bigInteger('classified_id')->nullable();
//            $table->bigInteger('question_id')->nullable();
//            $table->bigInteger('answer_id')->nullable();
            $table->bigInteger('parent_id')->nullable()->comment('Reply of a comment will have parent id which is the comment id');
            $table->text('comment');
            $table->bigInteger('total_likes')->default(0);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
