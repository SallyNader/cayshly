<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('PoId');
            $table->integer('PoUserId');
            $table->integer('PoProductId');
            $table->string('PoProductName');
            $table->float('PoAmount'); // ex: 30 points
            $table->integer('PoItemNums');
            $table->string('PoFrom'); // redeeming - purchasing
            $table->string('PoStatus'); // increased - decreased
            $table->string('PoBNumber');
            $table->timestamp('PoDate')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::drop('points');
    }
}
