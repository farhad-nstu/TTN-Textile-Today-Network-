<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessPointsTable extends Migration
{
    public function up()
    {
        Schema::create('access_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('access_point_name',200);
            $table->string('unique_code',100);
            $table->text('descr')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('access_points');
    }
}
