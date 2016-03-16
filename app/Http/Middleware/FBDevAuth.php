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
      return $next($request);
      if (!session_id()) {
          session_start();
      }

      if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()){
          $response = PagesController::getFBUser();
          $fbid = $response['id'];

          $testUser = DB::table('users')->select('test_user')->where('fb_id', '=', $fbid)->first();

          if ($testUser != NULL){
            $isTestUser = $testUser->test_user;

            if ($isTestUser){
              //Allow acces:
              return $next($request);
            }
          }

      }
      return redirect('construction');
    }
}
