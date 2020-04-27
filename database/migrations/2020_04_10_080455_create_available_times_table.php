<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_times', function (Blueprint $table) {
            $table->id('Available_Time_ID')->primary()->autoIncrement();
            $table->integer('Tutor_ID')->unsigned();
            $table->enum('Day', array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'));
            $table->time('Start_Time');
            $table->time('End_Time');
            $table->boolean('Is_Free');

            $table->foreign('Tutor_ID')
                ->references('User_ID')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_times');
    }
}
