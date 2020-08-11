<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invited_by');
            $table->bigInteger('invited_to');
            $table->morphs('invitationable');
//            $table->bigInteger('page_id')->nullable();
//            $table->bigInteger('group_id')->nullable();
            $table->tinyInteger('is_notification_seen')->default('0');
            $table->tinyInteger('status')->default('10');
            $table->dateTime('invited_at');
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
        Schema::dropIfExists('invitations');
    }
}
