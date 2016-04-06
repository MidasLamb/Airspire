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

    $data['passed_events'] = Event::where('ended_at', '<', date('Y-m-d   H:i:s'))->get();



    $evat = DB::table('event_attendences')->select('event_id')
      ->where('user_id', '=', $data['id'])->get();

    $data["nb_of_att"] = count($evat);

    $data["users_with_more_att"] =  count(DB::select('SELECT ea.user_id, COUNT(*) AS "Number of Attendences" FROM event_attendences ea GROUP BY ea.user_id HAVING COUNT(*) > ?', [count($evat)]));

    $data["users_with_all_att"] =  count(DB::select('SELECT ea.user_id, COUNT(*) AS "Number of Attendences" FROM event_attendences ea GROUP BY ea.user_id HAVING COUNT(*) = ?', [count($data['passed_events'])]));



    $ev = [];


    foreach($evat as $eva){
      array_push($ev, $eva->event_id);
    }

    $data['evats'] = $ev;

    return view('pages/events/pasport')->with($data);
  }

  /**
  *
  *
  */
  public function eventAttendence($hash, $time){

    Tracker::hit("eventAttendence");
    PagesController::fillData(array('id'));
    $data = PagesController::getData();

    $data['uri'] = 'events/'.$hash.'/'.$time;
    $data['succes'] = false;
    $data['in_time'] = false;
    $data['already_attended'] = false;
    $data['event_id'] = 0;

    $converted_time = base_convert($time, 16, 10);

    if($data['loggedin']) {


          $event = DB::table('events')
            ->select('id')
            ->where('hash', '=', $hash)
            ->first();

          if ($event != null){
            $eventId = $event->id;
            $data['event_id'] = $eventId;
            $fbId = $data['id'];

            $searchMatch = DB::table('event_attendences')
              ->where('user_id', '=', $fbId)
              ->where('event_id', '=', $eventId)
              ->first();

            if ($searchMatch == null){
              $currentTime = round(microtime(true)*1000);
              //If the time difference is more than 3 minutes, it took too long.
              if (abs($currentTime - $converted_time) < 1000*60*3){
                $data['in_time'] = true;

                DB::table('event_attendences')
                  ->insert(['user_id' => $fbId, 'event_id' => $eventId, 'created_at' => date('Y-m-d   H:i:s')]);
                $data['succes'] = true;
              }
            } else {
              // User already attended this event.
              $data['already_attended'] = true;
            }
          } else {
            // Event does not exist.

          }

    } else {
      // User is not logged in.
    }

    return view('pages/events/event_attend')->with($data);

  }



}
