<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('productcomments', function (Blueprint $table) {
            $table->increments('ProComId');
            $table->integer('ProComProId');
            $table->integer('ProComUserId');
            $table->text('ProComText');
            $table->timestamp('ProComDate')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::drop('productcomments');
    }
}
