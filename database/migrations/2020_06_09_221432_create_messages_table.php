<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('Message_ID') -> primary() -> autoIncrement();
            $table->integer('Sent_by') -> unsigned();
            $table->integer('Sent_to') -> unsigned();
            $table->string('Message');
            $table->dateTime('Date_Time');

            $table->foreign('Sent_by')
                ->references('User_ID')
                ->on('users');
            $table->foreign('Sent_to')
                ->references('User_ID')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
