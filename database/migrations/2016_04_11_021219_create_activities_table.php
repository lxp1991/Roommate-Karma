<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('action', ['taskTake', 'taskComplete', 'taskCreate', 'addressUpdate', 'userFollow', 'userUnfollow']);
            $table->dateTime('dateTime');
            $table->integer('userId');
            $table->integer('taskId');
            $table->integer('followingId');
            $table->integer('residenceId');
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
        Schema::drop('activities');
    }
}
