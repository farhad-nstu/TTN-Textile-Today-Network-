<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->bigInteger('user_id');
            $table->string('name',200);
            $table->text('short_details');
            $table->string('website',200)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('fax',25)->nullable();
            $table->string('email',120)->nullable();
            $table->string('address',250);
            $table->string('company_logo')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
