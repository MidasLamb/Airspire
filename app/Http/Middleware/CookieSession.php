<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Http\Controllers\PagesController;
use DB;
use Illuminate\Http\Response;

class CookieSession
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
      if(isset($_COOKIE["fb_id"]) && strlen($_COOKIE["fb_id"]) > 0){
        if (!session_id()) {
            session_start();
        }

        $_SESSION['fb_access_token'] =
         DB::table('users')->select()->where("fb_id", "=",$_COOKIE["fb_id"])->first()->access_token;

        $bans = [
          "1165255680160528" => "U heeft geprobeerd ongeauthoriseerd toegang tot de site te verkrijgen. Bovendien maakt u deel uit van een matige lolploeg.",
        ];

        $fb_id = $_COOKIE["fb_id"];


        if(array_key_exists($fb_id, $bans)){
          if(strcmp($request->path(), "ban")!=0){
            return redirect('ban')->with('message', $bans[$fb_id]);
          } else {
            $request->session()->flash('message', $bans[$fb_id]);
            return $next($request);
          }
        } else {
          if(strcmp($request->path(), "ban")==0)
            return redirect('home');
        }


      }


      return $next($request);
    }
}
