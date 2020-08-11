<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('platform_id');
            $table->string('title',100);
            $table->string('package_name',250);
            $table->string('short_descr',200);
            $table->text('descr');
            $table->string('logo',100);
            $table->string('promo_video_link',250)->nullable();
            $table->text('firebase_api_key');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
