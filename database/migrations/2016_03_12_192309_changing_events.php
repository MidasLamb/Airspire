<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangingEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('events', function ($table) {
        $table->renameColumn('published_at', 'started_at');
        $table->timestamp('ended_at')->after('published_at');
        $table->dropColumn('created_at');
        $table->dropColumn('updated_at');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('events', function ($table) {
        $table->renameColumn('started_at', 'published_at');
        $table->dropColumn('ended_at');
        $table->timestamps();
      });
    }
}
