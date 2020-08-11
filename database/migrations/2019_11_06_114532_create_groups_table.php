<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',250);
            $table->text('about_the_group')->nullable();
            $table->text('rules_to_join')->nullable();
            $table->text('security_question')->nullable();
            $table->text('answer')->nullable();
            $table->string('moto',250)->nullable();
            $table->string('logo',200)->nullable();
            $table->string('banner',200)->nullable();
            $table->bigInteger('total_member')->default('1');
            $table->bigInteger('total_post');
            $table->bigInteger('total_flag');
            $table->string('website',250)->nullable();
            $table->bigInteger('status')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
