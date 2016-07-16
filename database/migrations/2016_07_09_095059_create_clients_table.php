


<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('dear');
            $table->string('surname')->default('guest');
            $table->string('phone')->default('');
            $table->string('email')->default('');
            $table->date('birthday');
            $table->integer('remain')->unsigned()->default(5);
            $table->integer('user_id')->unsigned()->default(0);
            $table->timestamps('last_visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
