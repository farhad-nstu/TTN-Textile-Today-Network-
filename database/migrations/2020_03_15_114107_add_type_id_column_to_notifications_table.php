<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeIdColumnToNotificationsTable extends Migration
{
        /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->integer('type_id')->unsigned()->after('type')->nullable();
        });
    }

    /**
    * Reverse the migrations, if you're into this 🤷🏼‍♂️
    *
    * @return void
    */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropDolumn('type_id');
        });
    }
}
