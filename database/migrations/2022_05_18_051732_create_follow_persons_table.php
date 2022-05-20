<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id'); 
            $table->foreign('person_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('follower_id'); 
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('follow_persons');
    }
}
