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
      if (!session_id()) {
          session_start();
      }

      if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()){
          $response = PagesController::getFBUser();
          $fbid = $response['id'];
          $isTestUser = DB::table('users')->select('test_user')->where('fb_id', '=', $fbid)->first()->test_user;

          if ($isTestUser){
            //Allow acces:
            return $next($request);
          }
      }
      return redirect('construction');
    }
}
