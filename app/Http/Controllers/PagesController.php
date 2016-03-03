<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App;
use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Facebook\Exceptions;
use GuzzleHttp;
use Facebook\FacebookRequest;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{

    public function welcome(){

        return view('pages/welcome');
    }

    public function events()
    {
        if (!session_id()) {
            session_start();
        }



        $data = [
            'title' => "Events",
            'events' => App\Event::all(),
        ];

        if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()) {
            $response = $this->getFBUser();
            $data['user'] = $response['name'];
            $data['image'] = $response['picture']['url'];
            $data['loggedin'] = true;
        } else {
            $data['user'] = '';
            $data['image'] = '';
            $data['loggedin'] = false;
        }

        return view('pages/events')->with($data);
    }

    public function aboutus()
    {
        if (!session_id()) {
            session_start();
        }
        $data = [
            'title' => "About us",

        ];

        if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()) {
            $response = $this->getFBUser();
            $data['user'] = $response['name'];
            $data['image'] = $response['picture']['url'];
            $data['loggedin'] = true;
        } else {
            $data['user'] = '';
            $data['image'] = '';
            $data['loggedin'] = false;
        }

        return view('pages/aboutus')->with($data);
    }


    public function home()
    {
        if (!session_id()) {
            session_start();
        }

        if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()){
            $response = $this->getFBUser();
            $data = [
                'loggedin' => true,
                'user' => $response['name'],
                'image' => $response['picture']['url'],
                'loginurl' => $this->makeLoginURL(),
                'title' => 'home',

            ];
        } else {
            $data = [
                'loggedin' => false,
                'user' => "",
                'image' => "",
                'loginurl' => $this->makeLoginURL(),
                'title' => 'home'
                ];
        }

        return view('pages/home')->with($data);
    }

    public function QRCode(){
      if (!session_id()) {
          session_start();
      }
      $data = [
        'title' => "QRCode",

      ];

      if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()) {
          $response = $this->getFBUser();
          $data['id'] = $response['id'];
          $data['user'] = $response['name'];
          $data['image'] = $response['picture']['url'];
          $data['loggedin'] = true;
      } else {
        $data['id'] = "";
        $data['user'] = "";
        $data['image'] = "";
        $data['loggedin'] = false;
      }
      return view('pages/QRCode')->with($data);
    }

    /**
    * First check if user is logged in
    *  $time should be in seconds, because time() returns seconds.
    */
    public function eventAttendence($hash, $time){
      if (!session_id()) {
          session_start();
      }

      if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()) {
          $response = $this->getFBUser();
          $data['id'] = $response['id'];

          $data['user'] = $response['name'];
          $data['image'] = $response['picture']['url'];
          $data['loggedin'] = true;

          $currentTime = time();
          if ($currentTime - $time > 0){
            $event = DB::table('events')->select('id')->where('hash', '=', $hash)->first();
            if ($event != null){
              var_dump($eventId);
              $eventId = $event->id;
              $fb_id = $response['id'];

              $searchMatch = DB::table('event_attendences')
                ->where('user_id', '=', $fb_id)
                ->where('event_id', '=', $eventId)
                ->first();

              if ($searchMatch == null){
                DB::table('event_attendences')->insert(
                  ['user_id' => $response['id'], 'event_id' => $event_id]
                );
                echo "User added";
              }
            }
            echo "event not found";

          }


          $data['succes'] = true;


      } else {
        $data['id'] = "";
        $data['user'] = "";
        $data['image'] = "";
        $data['succes'] = false;
        $data['loggedin'] = false;

        echo "not logged in";
      }



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

    $fb = $this->getFB();



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
            throw new Exception('Session not started.');
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

    private function makeLoginURL(){
        $fb = self::getFB();
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['id', 'name', 'picture', 'email']; // optional
        $loginUrl = $helper->getLoginUrl('http://localhost:8000/loginFallback', $permissions);

        return $loginUrl;
    }

}
