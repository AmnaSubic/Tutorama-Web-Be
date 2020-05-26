<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('Class_ID')->primary()->autoIncrement();
            $table->integer('Service_ID')->unsigned();
            $table->integer('Student_ID')->unsigned();
            $table->date('Date');
            $table->time('Start_at');
            $table->time('End_at');
            $table->string('Place',255);
            $table->decimal('Price',10,2);
            $table->enum('Status', array('Pending','Accepted','Rejected','Finished','Cancelled','Started'));
            $table->enum('Stu_Status', array('Started', 'Finished', 'Cancelled'));

            $table->foreign('Service_ID')
                ->references('Service_ID')
                ->on('services')
                ->onDelete('cascade');
            $table->foreign('Student_ID')
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
        Schema::dropIfExists('classes');
    }
}
