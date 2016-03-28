<?php

namespace App\Http\Controllers;

use Log;
use App\Http\Requests;
use App\User;
use Facebook\Facebook;
use Facebook\Exceptions;
use Illuminate\Support\Facades\Redirect;
use PhpSpec\Exception\Exception;
use App\Exceptions\Handler;

class AuthController extends Controller
{

  public function loginPost($page){

      if(!session_id()) {
          session_start();
      }

      $fb = new Facebook([
          'app_id' => env('FACEBOOK_APP_ID'),
          'app_secret' => env('FACEBOOK_APP_SECRET'),
          'default_graph_version' => 'v2.2',
      ]);

      try {
          $helper = $fb->getJavaScriptHelper();
      }catch(Exception $e){
          Log::error('Javascripthelper threw an error');
          header("Refresh:0");
          exit;
      }catch(Exceptions\FacebookSDKException $e){
          Log::error('Javascripthelper threw an error');
          header("Refresh:0");

          exit;
      }



      try {
          $accessToken = $_POST['token'];
      } catch(Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          Log::error('Graph returned an error: ' . $e->getMessage());
          exit;
      } catch(Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          Log::error('Facebook SDK returned an error: ' . $e->getMessage());

          exit;
      }

      if (! isset($accessToken)) {
          Log::error('No cookie set or no OAuth data could be obtained from cookie.');

      }

//
//        // Logged in
//
      $_SESSION['fb_access_token'] = (string) $accessToken;

      // User is logged in!


      $fb_user = PagesController::getFBUser();
      $data = [
            'fb_id' => $fb_user['id'],
            'name' => $fb_user['name'],
            'access_token' => (string) $accessToken
      ];

      if (isset($fb_user['email']))
        $data['email'] = $fb_user['email'];

      $user = User::find($fb_user['id']);
      if (is_null($user)){
          $user = User::create($data);
      } else {
          $user->access_token = (string) $accessToken;
          $user->save();
      }


      return Redirect::to('/'.$page);
  }

    public function login($page){
        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.2',
        ]);

        try {
            $helper = $fb->getJavaScriptHelper();
        }catch(Exception $e){
            Log::error('Javascripthelper threw an error');
            header("Refresh:0");
            exit;
        }catch(Exceptions\FacebookSDKException $e){
            Log::error('Javascripthelper threw an error');
            header("Refresh:0");

            exit;
        }



        try {
            $accessToken = $helper->getAccessToken();
        } catch(Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            Log::error('Graph returned an error: ' . $e->getMessage());
            exit;
        } catch(Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            Log::error('Facebook SDK returned an error: ' . $e->getMessage());

            exit;
        }

        if (! isset($accessToken)) {
            Log::error('No cookie set or no OAuth data could be obtained from cookie.');

        }


        if (! $accessToken->isLongLived()) {
            $oAuth2Client = $fb->getOAuth2Client();
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>";
                exit;
            }



        }
//
//        // Logged in
//
        $_SESSION['fb_access_token'] = (string) $accessToken;

        // User is logged in!


        $fb_user = PagesController::getFBUser();
        $data = [
              'fb_id' => $fb_user['id'],
              'name' => $fb_user['name'],
              'access_token' => (string) $accessToken
        ];

        if (isset($fb_user['email']))
          $data['email'] = $fb_user['email'];

        $user = User::find($fb_user['id']);
        if (is_null($user)){
            $user = User::create($data);
        } else {
            $user->access_token = (string) $accessToken;
            $user->save();
        }


        return Redirect::to('/'.$page);
    }

    public function loginFallback(){
        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.2',
        ]);


        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

    // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId( env('FACEBOOK_APP_ID'));
    // If you know the user ID this access token belongs to, you can validate it here
    // $tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>";
                exit;
            }
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;


// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
// header('Location: https://example.com/members.php');

        return Redirect::to('/home');
    }




    public function logout($page){
        if(!session_id()) {
            session_start();
        }

        unset( $_SESSION['fb_access_token']);

        return Redirect::to('/'.$page);
    }

}
