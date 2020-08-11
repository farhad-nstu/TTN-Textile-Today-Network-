<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassfiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifieds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->integer('classified_category_id')->comment('Tools, Machinaries, Yarn etc');
            $table->smallInteger('classified_type_id')->comment('Featured, Premium etc');
            $table->bigInteger('organization_id')->nullable();
            $table->smallInteger('classified_position_id')->nullable();
            $table->string('title',250);
            $table->text('details');
            $table->tinyInteger('is_service')->default(0);
            $table->tinyInteger('is_selling')->default(1);
            $table->bigInteger('total_views')->default(0);
            $table->integer('total_like')->default(0);
            $table->integer('total_clicks')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->dateTime('impression_starts_at')->nullable();
            $table->dateTime('impression_ends_at')->nullable();
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
        Schema::dropIfExists('classifieds');
    }
}
