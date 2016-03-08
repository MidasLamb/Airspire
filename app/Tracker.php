<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    public $attributes = [ 'hits' => 0 ];

    protected $fillable = [ 'ip', 'date' ];

    public static function boot() {
        // Any time the instance is updated (but not created)
        static::saving( function ($tracker) {
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }

    public static function hit($page) {
        static::firstOrCreate([
                  'ip'   => $_SERVER['REMOTE_ADDR'],
                  'date' => date('Y-m-d'),
              ])->save();
        static::where('ip', $_SERVER['REMOTE_ADDR'])->where('date', date('Y-m-d'))->update(['last_page' => $page]);
    }
}
