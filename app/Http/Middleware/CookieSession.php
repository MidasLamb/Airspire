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

      if (!session_id()) {
          session_start();
      }

      if(isset($_SESSION['fb_access_token']) && strlen($_SESSION['fb_access_token'])>0 && !isset($_COOKIE["fb_id"])){
        var_dump($_SESSION['fb_access_token']);
        $idt = DB::table('users')->select()->where("access_token", "=",$_SESSION['fb_access_token'])->first();
        var_dump($idt);



        $id = $idt->fb_id;




        $cookie_name = "fb_id";
        $cookie_value = $id;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
      } else if(isset($_COOKIE["fb_id"])&& strlen($_COOKIE["fb_id"]) > 0){

        $_SESSION['fb_access_token'] =
         DB::table('users')->select()->where("fb_id", "=",$_COOKIE["fb_id"])->first()->access_token;

      }

      throw new Exception('Division by zero.');

      return $next($request);
    }
}
