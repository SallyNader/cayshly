<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function(Blueprint $table){
            $table->increments('id');
            $table->integer('cat_id');
            $table->string('sub_cat_name_en')->unique();
            $table->string('sub_cat_name_ar')->unique();
            $table->string('sub_cat_create_time');
            $table->string('sub_cat_create_who');
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
        Schema::drop('subcategories');
    }
}
