<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 32);
            $table->date('date');
            $table->integer('hits')->unsigned();
            $table->time('visit_time');
            $table->string('last_page', 32);
            $table->timestamps();
            $table->index(['ip', 'date']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trackers');
    }
}
