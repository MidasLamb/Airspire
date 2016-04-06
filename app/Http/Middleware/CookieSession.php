<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Http\Controllers\PagesController;
use DB;

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
      if(isset($_COOKIE["fb_access_cookie"])){
        $_SESSION['fb_access_token'] = $_COOKIE["fb_access_cookie"];
      }

      return $next($request);
    }
}