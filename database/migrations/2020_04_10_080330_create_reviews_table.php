<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('Review_ID')->primary()->autoIncrement();
            $table->integer('Tutor_ID')->unsigned();
            $table->integer('Student_ID')->unsigned();
            $table->decimal('Rating',1,2);
            $table->date('Date');
            $table->text('Description');
            $table->boolean('Is_Tutor');

            $table->foreign('Tutor_ID')
                ->references('User_ID')
                ->on('users')
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
        Schema::dropIfExists('reviews');
    }
}
