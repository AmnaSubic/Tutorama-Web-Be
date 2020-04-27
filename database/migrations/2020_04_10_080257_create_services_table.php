<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('Service_ID')->primary()->autoIncrement();
            $table->integer('Tutor_ID')->unsigned();
            $table->integer('Subject_ID')->unsigned();
            $table->enum('Service_Level', array('Elementary','HighSchool','University','On Demand'));
            $table->integer('Service_Cost');

            $table->foreign('Tutor_ID')
                ->references('User_ID')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('Subject_ID')
                ->references('Subject_ID')
                ->on('subjects')
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
        Schema::dropIfExists('services');
    }
}
