<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('event_attendences', function($table)
        {
          $table->integer('event_id')->length(10)->unsigned()->change();
          $table->foreign('user_id')->references('fb_id')->on('users');
          $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('event_attendences', function($table)
        {
          $table->dropforeign('user_id');
          $table->dropforeign('event_id');
        });
    }
}
