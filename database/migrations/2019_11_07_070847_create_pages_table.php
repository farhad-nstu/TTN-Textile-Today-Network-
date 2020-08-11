<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_category_id');
//            $table->bigInteger('created_by');
            $table->string('title',250);
            $table->text('about')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('email',120)->nullable();
            $table->string('website',150)->nullable();
            $table->string('logo',200)->nullable();
            $table->string('banner',200)->nullable();
            $table->bigInteger('total_like')->default('0');
            $table->bigInteger('total_follow')->default('0');
            $table->tinyInteger('status');
            $table->date('starts_at');
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
        Schema::dropIfExists('pages');
    }
}
