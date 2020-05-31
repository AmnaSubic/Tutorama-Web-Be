<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('User_ID') -> primary() -> autoIncrement();
            $table->string('Email',255) -> unique();
            $table->string('Username',255) -> unique();
            $table->string('Password',255);
            $table->string('First_Name',255);
            $table->string('Last_Name',255);
            $table->date('Date_of_Birth');
            $table->boolean('Gender');
            $table->string('Address',255);
            $table->string('Town',255);
            $table->string('Country',255);
            $table->string('Phone_Number',255);
            $table->string('Description',1000) -> nullable();
            $table->boolean('Is_Tutor');
            $table->string('Experience', 255) -> nullable();
            $table->enum('Availability', array('Fixed','Flexible')) -> nullable();
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
