<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('role_id');
            $table->string('name', 100);
            $table->string('username')->nullable();
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('alternate_phone', 20)->nullable();
            $table->string('password', 200);
            $table->rememberToken();
            $table->string('verified_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('token_sent_at')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('post_code', 15)->nullable();
            $table->string('address', 250)->nullable();
            $table->text('about_yourself')->nullable();
            $table->string('billing_address', 250)->nullable();
            $table->string('alternate_billing_address', 250)->nullable();
            $table->string('profile_picture', 200)->nullable();
            $table->string('background_banner', 250)->nullable();
            $table->string('facebook_link', 250)->nullable();
            $table->string('twitter_link', 250)->nullable();
            $table->string('linkedin_link', 250)->nullable();
            $table->string('instagram_link', 250)->nullable();
            $table->string('youtube_link', 250)->nullable();
            $table->string('website', 200)->nullable();
            $table->text('qr_code')->nullable();
            $table->string('slack_channel')->nullable();
            $table->string('resume', 200)->nullable()->comment('Uploaded Resume');
            $table->integer('total_questions')->default(0);
            $table->integer('total_answers')->default(0);
            $table->integer('total_score')->default(0);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
