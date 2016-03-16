<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Tracker;
use App\Event;

class EventsController extends Controller
{
  public function events()
  {

      Tracker::hit("events");
      PagesController::fillData();
      $data = PagesController::getData();

      $data['events'] = Event::all();

      return view('pages/events/events')->with($data);
  }

  public function event($id){
    Tracker::hit("events");
    PagesController::fillData();
    $data = PagesController::getData();


    $data['event'] = Event::find($id);

    return view('pages/events/event')->with($data);
  }

  public function pasport()
  {
    Tracker::hit("pasport");
    PagesController::fillData(array('id'));
    $data = PagesController::getData();
    $data['events'] = Event::all();

    $evat = DB::table('event_attendences')->select('event_id')
      ->where('user_id', '=', $data['id'])->get();




    $ev = [];


    foreach($evat as $eva){
      array_push($ev, $eva->event_id);
    }

    $data['evats'] = $ev;

    return view('pages/events/pasport')->with($data);
  }

  /**
  * First check if user is logged in
  *  $time should be in seconds, because time() returns seconds.
  */
  public function eventAttendence($hash, $time){

    Tracker::hit("eventAttendence");
    PagesController::fillData(array('id'));
    $data = PagesController::getData();

    $data['uri'] = 'events/'.$hash.'/'.$time;

    if($data['loggedin']) {
        $currentTime = time();
        if ($currentTime - $time > 0){
          $event = DB::table('events')
            ->select('id')
            ->where('hash', '=', $hash)
            ->first();

          if ($event != null){
            $eventId = $event->id;
            $fbId = $data['id'];

            $searchMatch = DB::table('event_attendences')
              ->where('user_id', '=', $fbId)
              ->where('event_id', '=', $eventId)
              ->first();

            if ($searchMatch == null){
              DB::table('event_attendences')
                ->insert(['user_id' => $fbId, 'event_id' => $eventId, 'created_at' => date('Y-m-d   H:i:s')]);
            }
          }


        } else {
          // Time difference is too big
        }


        $data['succes'] = true;


    } else {

    }

    return view('pages/events/event_attend')->with($data);

  }



}
