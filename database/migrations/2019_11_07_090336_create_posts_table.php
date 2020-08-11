<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->integer('post_type_id');
            $table->nullableMorphs('postable');
//            $table->bigInteger('page_id')->nullable();
//            $table->bigInteger('group_id')->nullable();
            $table->string('title',250)->nullable();
            $table->longText('descr');
            $table->tinyInteger('status');
            $table->tinyInteger('is_article')->default('0');
            $table->integer('total_like')->default('0');
            $table->integer('total_share')->default('0');
            $table->integer('total_comment')->default('0');
            $table->integer('total_views')->default('0');
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
        Schema::dropIfExists('posts');
    }
}
