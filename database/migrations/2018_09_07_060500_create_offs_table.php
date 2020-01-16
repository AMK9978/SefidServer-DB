<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('percent')->unsigned();
            $table->string('product_name');
            $table->integer('product_price');
            $table->timestamp('expired_time');
            $table->integer('count')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->integer('quiz_game_id')->unsigned();
            $table->foreign('quiz_game_id')->references('id')->on('quiz_games')->onDelete('cascade');
            $table->string('off_code');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('offs');
    }
}
