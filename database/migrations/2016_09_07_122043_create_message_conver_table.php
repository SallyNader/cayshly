<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageConverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messageconvers', function (Blueprint $table) {
            $table->increments('MsgConvId');
            $table->integer('MsgConvMsgId');
            $table->integer('MsgConvUserId');
            $table->string('MsgConvTxt');
            $table->timestamp('MsgConvDate')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::drop('messageconvers');
    }
}
