<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('training_code', 100)->unique();
            $table->text('details')->nullable();
            $table->string('duration', 200);
            $table->string('venue', 200);
            $table->float('discount')->nullable()->default(0);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('registration_deadline');
            $table->string('contact_phone_no', 20)->nullable();
            $table->string('alternate_contact_phone', 20)->nullable();
            $table->string('contact_email', 150)->nullable();
            $table->string('alternate_contact_email', 150)->nullable();
            $table->integer('total_views')->default(0);
            $table->integer('total_flag')->default(0);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('trainings');
    }
}
