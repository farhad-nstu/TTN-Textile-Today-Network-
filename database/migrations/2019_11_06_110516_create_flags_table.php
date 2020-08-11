<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('flaggable');
//            $table->bigInteger('post_id')->nullable();
//            $table->bigInteger('group_id')->nullable();
//            $table->bigInteger('page_id')->nullable();
//            $table->bigInteger('event_id')->nullable();
//            $table->bigInteger('question_id')->nullable();
//            $table->bigInteger('classified_id')->nullable();
//            $table->bigInteger('training_id')->nullable();
            $table->bigInteger('flag_by');
            $table->text('flagging_reason');
            $table->dateTime('flagged_at');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flags');
    }
}
