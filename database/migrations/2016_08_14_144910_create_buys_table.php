<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('BId');
            $table->integer('BUserId');
            $table->integer('BProId');
            $table->integer('BProQuant');
            $table->string('BAddress');
            $table->timestamp('BDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('BStatus')->default(1);
            $table->string('BNumber');
            $table->boolean('BReviewd')->default(0);
            $table->boolean('BValidTransaction')->default(0);
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
        Schema::drop('buys');
    }
}
