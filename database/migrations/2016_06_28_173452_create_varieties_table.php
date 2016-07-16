<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  CreateVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
            Schema::create('varieties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('default');
            $table->integer('cost')->unsigned()->default(0);
            $table->integer('product_id')->unsigned()->default(0);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps('variety_registered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('varieties');
    }
}
