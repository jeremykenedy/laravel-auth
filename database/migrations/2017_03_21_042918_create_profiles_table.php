<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            //Structure
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->unsignedBigInteger('theme_id')->unsigned()->default(1);
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('github_username')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('avatar_status')->default(0);
            $table->timestamps();

            //Relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
