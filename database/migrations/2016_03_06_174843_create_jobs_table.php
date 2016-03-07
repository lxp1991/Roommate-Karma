<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobId');
            $table->integer('taskId');
            $table->integer('residenceId');
            $table->integer('userId');
            $table->integer('karmaScores');
            $table->dateTime('releaseDate');
            $table->dateTime('deadline');
            $table->string('comments');
            $table->boolean('isActive')->default(TRUE);
            $table->boolean('isTaken')->default(FALSE);
            $table->boolean('isCompleted')->default(FALSE);
            $table->boolean('isBounty')->default(FALSE);
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
        Schema::drop('jobs');
    }
}
