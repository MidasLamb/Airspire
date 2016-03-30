<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayThatCardTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ptcTrackers', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ip', 32);
        $table->string('fb_id')->nullable();
        $table->date('date');
        $table->integer('hits')->unsigned();
        $table->time('visit_time');
        $table->timestamps();
        $table->index(['ip', 'date']);

        $table->foreign('fb_id')->references('fb_id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ptcTrackers');
    }
}
