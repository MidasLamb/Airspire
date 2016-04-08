<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Http\Controllers\PagesController;
use DB;

class OnlineCheck
{

  protected $except = [
      "construction"
  ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      $startHour = 22;
      $day = 10;
      $startDate = date('Y-m-d   H:i:s', mktime($startHour, 0, 0, 4, $day, 2016));
      $now = date('Y-m-d   H:i:s');



      if($startDate > $now){
        PagesController::fillData(array('id'));
        $data = PagesController::getData();

        if(strcmp(substr($request->path(), 0,5), "login")==0){
          return $next($request);
        }

        if(PagesController::isValidAccessToken()){
            $response = PagesController::getFBUser();
            $fbid = $response['id'];

            $testUser = DB::table('users')->select('test_user')->where('fb_id', '=', $fbid)->first();

            if ($testUser != NULL){
              $isTestUser = $testUser->test_user;
              if ($isTestUser){
                //Allow acces:
                if(strcmp($request->path(), "construction")==0){
                  return redirect("/");
                }else {
                  return $next($request);
                }
              }
            }
        }
          if(strcmp($request->path(), "construction")==0){
            return $next($request);
          }else {
            return redirect("construction");
          }
      } else {
        return $next($request);
      }


    }
}
