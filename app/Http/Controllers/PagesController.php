<?php

namespace App\Http\Controllers;

use Exception;
use App\Tracker;
use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App;
use App\Event;
use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Facebook\Exceptions;
use GuzzleHttp;
use Facebook\FacebookRequest;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    private static $data;

    public function welcome()
    {
        Tracker::hit("welcome");

        return view('pages/welcome');

    }





    public function aboutus()
    {
        Tracker::hit("aboutus");
        PagesController::fillData();

        return view('pages/aboutus')->with(PagesController::$data);
    }

    public function media()
    {
        Tracker::hit("media");
        PagesController::fillData();

        return view('pages/media/media')->with(PagesController::$data);
    }


    public function home()
    {
        Tracker::hit("home");
        PagesController::fillData(array('id'));
        $data = PagesController::getData();

        //
        $data['upcoming_events'] = Event::where('started_at', '>', date('Y-m-d   H:i:s'))->get();

        $data['passed_events'] = Event::where('ended_at', '<', date('Y-m-d   H:i:s'))->get();

        $data['active_events'] = Event::where('started_at', '<', date('Y-m-d   H:i:s'))->where('ended_at', '>', date('Y-m-d   H:i:s'))->get();


        if ($data['loggedin']){
          $data['attended_events'] = DB::table('events')
              ->join('event_attendences', 'events.id', '=', 'event_attendences.event_id')
              ->select('title', 'country_name', 'country_flag')
              ->where('user_id', '=', $data['id'])
              ->orderBy('ended_at', 'desc')
              ->get();



          $data['nb_attended_events'] = count($data['attended_events']);
        }
        $data['nb_passed_events'] = count($data['passed_events']);


        return view('pages/home')->with($data);
    }

    public function QRCode(){
      Tracker::hit("QRCode");
      PagesController::fillData(array('id'));

      return view('pages/QRCode')->with(PagesController::$data);
    }




    /**
     * Returns an array with the "id", "name", "email", and "picture".
     * The picture is an array with boolean "is_silhouette" and a string "url".
     * If access token is not set, it throws an exception.
     * @return array
     * @throws Exception |if(!isset($_SESSION['fb_access_token'])
     */
    public static function getFBUser()
    {
        if (!session_id()) {
            throw new Exception('Session not started.');
        }

        if (!isset($_SESSION['fb_access_token'])){
            throw new Exception('No access token.');
        }


        $fb = PagesController::getFB();

        try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me?fields=id,name,picture,email', $_SESSION['fb_access_token']);
                $return = $response->getGraphNode()->asArray();
            } catch (Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                if ($e->getCode() == 190) {
                    //acces token expired.
                } else {
                }
                exit;
            } catch (Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }



        return $return;
    }

    /**
     * Only returns friends who already accepted the app.
     * If access token is not set, it throws an exception.
     * @return \Facebook\GraphNodes\GraphEdge
     * @throws Exception |if(!isset($_SESSION['fb_access_token'])
     */
    private function getFBFriends()
    {

        if (!session_id()) {
            session_start();
        }
        if (!isset($_SESSION['fb_access_token'])){
            throw new Exception('No access token set.');
        }

    $fb = PagesController::$getFB();



            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get(
                    '/me/friends', $_SESSION['fb_access_token']
                );
                $friends = $response->getGraphEdge();
            } catch (Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();

                if ($e->getCode() == 190) {
                    //Access Token expired
                    return Redirect::to('/logout');
                } else {
                }
                exit;
            } catch (Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            return $friends;

    }

    /**
     * Returns the fb variable with this app's id and secret.
     * @return Facebook
     */
    private static function getFB(){

        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.2',
        ]);

        return $fb;
    }

    public static function isValidAccessToken(){
        if (!session_id()) {
            session_start();
        }

        if (!isset($_SESSION['fb_access_token'])){
            return false;
        }


        $fb = PagesController::getFB();

        try {
            // Returns a `Facebook\FacebookResponse` object
            $fb->get('/me?fields=id,name,picture,email', $_SESSION['fb_access_token']);
        } catch (Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            if ($e->getCode() == 190) {
                //Access token has expired.
                unset($_SESSION['fb_access_token']);
                return false;
            } else {
                return false;
            }
            exit;
        } catch (Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    public static function fillData($extras = null){
      if(PagesController::isValidAccessToken()) {
          $response = PagesController::getFBUser();
          PagesController::$data['user'] = $response['name'];
          PagesController::$data['image'] = $response['picture']['url'];
          PagesController::$data['loggedin'] = true;
          if (isset($extras)){
            foreach($extras as $extra){
              PagesController::$data[$extra] = $response[$extra];
            }
          }

      } else {
          PagesController::$data['user'] = '';
          PagesController::$data['image'] = '';
          PagesController::$data['loggedin'] = false;
          if (isset($extras)){
            foreach($extras as $extra){
              PagesController::$data[$extra] = '';
            }
          }
      }
    }

    public static function isDeveloper($fbId){
      return false;
      $testUser = DB::table('users')->select('test_user')->where('fb_id', '=', $fbId)->first();

      if ($testUser != NULL){
        $isTestUser = $testUser->test_user;

        if ($isTestUser){
          //Allow acces:
          return true;
        }
      }
      return false;
    }

    public static function getData(){
      return PagesController::$data;
    }

    private function makeLoginURL(){
        $fb = self::getFB();
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['id', 'name', 'picture', 'email']; // optional
        $loginUrl = $helper->getLoginUrl('http://localhost:8000/loginFallback', $permissions);

        return $loginUrl;
    }

}
