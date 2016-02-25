<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Dev reroute route

use App\Http\Controllers\PagesController;
use App\Http\Requests;
use App\User;
use Facebook\Facebook;
use Facebook\Exceptions;
use Illuminate\Support\Facades\Redirect;
use PhpSpec\Exception\Exception;
use App\Exceptions\Handler;

Route::get('construction', function(){


  if (!session_id()) {
      session_start();
  }



  if(isset($_SESSION['fb_access_token']) && PagesController::isValidAccessToken()) {
      $response = PagesController::getFBUser();
      $data['loggedin'] = true;
  } else {
      $data['loggedin'] = false;
  }

  return view('dev')->with($data);
});


Route::get('/','PagesController@welcome')->middleware(['auth.dev']);

Route::get('events', 'PagesController@events')->middleware(['auth.dev']);

Route::get('login/{page}', 'AuthController@login');
//
//Route::get('loginFallback', 'AuthController@loginFallback');

Route::get('logout/{page}', 'AuthController@logout')->middleware(['auth.dev']);

Route::get('test', 'PagesController@test')->middleware(['auth.dev']);

Route::get('home', 'PagesController@home')->middleware(['auth.dev']);

Route::get('aboutus', 'PagesController@aboutus')->middleware(['auth.dev']);

//QR Code:

Route::get('QRCode', 'PagesController@QRCode')->middleware(['auth.dev']);

Route::post('eventattendeces',['middleware' => 'auth.quick', 'uses' => 'DBController@store']);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
