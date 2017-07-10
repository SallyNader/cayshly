<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('Sid');
            $table->integer('SUserId');
            $table->string('SName');
            $table->string('SPhone');
            $table->string('SEmail');
            $table->string('SImg');
            $table->string('SCover');
            $table->string('SWebsite');
            $table->text('PDescription');
            $table->tinyInteger('SDelete');
            $table->tinyInteger('SIsPlan');
            $table->tinyInteger('SActive');
            $table->string('SCreatedAt');
            $table->string('SExpireAt');
            $table->integer('SViews');
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
        Schema::drop('stores');
    }
}
