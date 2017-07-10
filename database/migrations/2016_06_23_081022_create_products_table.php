<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ProId');
            $table->integer('ProStoreId');
            $table->integer('ProCatId');
            $table->integer('ProSubCatId');
            $table->float('ProPrice');
            $table->string('ProPriceType');
            $table->string('ProName');
            $table->string('ProCondition');
            $table->string('ProWarranty');
            $table->string('ProDefaultImg');
            $table->string('ProVideo');
            $table->text('ProDescription');
            $table->integer('ProPoints');
            $table->tinyInteger('ProShow');
            $table->integer('ProViews');
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
        Schema::drop('products');
    }
}
