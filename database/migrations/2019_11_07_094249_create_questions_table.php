<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('created_by');
            $table->integer('question_category_id');
            $table->string('title',250);
            $table->text('details');
            $table->tinyInteger('id_faq')->default('0');
            $table->integer('up_vote')->default('0');
            $table->integer('down_vote')->default('0');
            $table->integer('total_flag')->default('0');
            $table->integer('total_answer')->default('0');
            $table->integer('total_view')->default('0');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('questions');
    }
}
