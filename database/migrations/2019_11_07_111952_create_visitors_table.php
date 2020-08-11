<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_ip', 30);
            $table->morphs('visitorable');
            $table->dateTime('visited_at');
            $table->timestamps();
//            $table->bigInteger('post_id')->nullable();
//            $table->bigInteger('job_id')->nullable();
//            $table->integer('question_id')->nullable();
//            $table->integer('classified_id')->nullable();
//            $table->integer('event_id')->nullable();
//            $table->integer('training_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
