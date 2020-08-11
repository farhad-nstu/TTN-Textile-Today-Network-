<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->bigInteger('user_id')->comment('Who posted the job');
            $table->integer('job_type_id');
            $table->string('title',250);
            $table->bigInteger('organization_id');
            $table->string('job_location',100);
            $table->integer('total_vacancy')->default('1');
            $table->date('application_deadline');
            $table->string('salary_range',200);
            $table->integer('minimum_experience')->nullable();
            $table->integer('maximum_experience')->nullable();
            $table->integer('minimum_age')->nullable();
            $table->integer('maximum_age')->nullable();
            $table->integer('preferred_gender')->nullable();
            $table->text('responsibilities');
            $table->text('requirements');
            $table->text('other_benefits');
            $table->text('special_instruction')->nullable();
            $table->bigInteger('total_views')->default('0');
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
        Schema::dropIfExists('jobs');
    }
}
