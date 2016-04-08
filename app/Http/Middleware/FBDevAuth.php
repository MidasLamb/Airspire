<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Http\Controllers\PagesController;
use DB;

class FBDevAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      //return $next($request);

      PagesController::fillData();
      $data = PagesController::getData();
      $acc_dev = true;

      if(PagesController::isValidAccessToken()){
          $response = PagesController::getFBUser();
          $fbid = $response['id'];

          $testUser = DB::table('users')->select('test_user')->where('fb_id', '=', $fbid)->first();

          if ($testUser != NULL){
            $isTestUser = $testUser->test_user;

            if ($isTestUser){
              //Allow acces:
              return $next($request);
            } else {
              //echo "You are not allowed";
            }
          } else{
            //echo "User does not exist in database";
          }

      }

      var_dump($acc_dev);
      return redirect('home')->with('acc_dev', $acc_dev);
    }
}
