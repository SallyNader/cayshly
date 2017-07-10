<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userhobbies', function(Blueprint $table){
            $table->increments('uHobId');   // User Hobby Id
            $table->integer('uHobHobId');   // Hobbies Id
            $table->integer('uHobUserId');  // User Id
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
        Schema::drop('userHobbies');
    }
}
