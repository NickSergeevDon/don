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
            $table->increments('id');
            $table->string('name')->default('default');
            $table->string('preview');
            $table->boolean('public')->default(true);
            $table->integer('group_id')->unsigned()->default(0);
            $table->foreign('group_id')->references('id')->on('productgroups')->onDelete('cascade');
           $table->timestamps('product_registered');
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
