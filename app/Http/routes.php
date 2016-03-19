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

//Events --------------------------------------------------------------

Route::get('events', 'EventsController@events')->middleware(['auth.dev']);
Route::get('events/{id}', array('as' => 'event','uses' =>'EventsController@event'))->middleware(['auth.dev']);

//Pasport --------------------------------------------------------------

Route::get('pasport', 'EventsController@pasport')->middleware(['auth.dev']);

//Login ------------------------------------------------------------

Route::get('login/{page}', 'AuthController@login');
//
//Route::get('loginFallback', 'AuthController@loginFallback');

Route::get('logout/{page}', 'AuthController@logout')->middleware(['auth.dev']);

//Info pages -------------------------------------------------------

Route::get('home', 'PagesController@home')->middleware(['auth.dev']);

Route::get('aboutus', 'PagesController@aboutus')->middleware(['auth.dev']);


//QR Code --------------------------------------------------------------

Route::get('QRCode', 'PagesController@QRCode')->middleware(['auth.dev']);

Route::post('eventattendeces',['middleware' => 'auth.quick', 'uses' => 'DBController@store']);


Route::get('events/{hash}/{time}', 'EventsController@eventAttendence')->middleware(['auth.dev']);


//Albums ---------------------------------------------------------------
Route::get('/media', array('as' => 'index','uses' => 'AlbumsController@getList'));
Route::get('/media/createalbum', array('as' => 'create_album_form','uses' => 'AlbumsController@getForm'));
Route::post('/media/createalbum', array('as' => 'create_album','uses' => 'AlbumsController@postCreate'));
Route::get('/media/deletealbum/{id}', array('as' => 'delete_album','uses' => 'AlbumsController@getDelete'));
Route::get('/media/album/{id}', array('as' => 'show_album','uses' => 'AlbumsController@getAlbum'));

Route::get('/media/addimage/{id}', array('as' => 'add_image','uses' => 'ImageController@getForm'));
Route::post('/media/addimage', array('as' => 'add_image_to_album','uses' => 'ImageController@postAdd'));
Route::get('/media/deleteimage/{id}', array('as' => 'delete_image','uses' => 'ImageController@getDelete'));
Route::get('/media/image/{id}', array('as' => 'show_image','uses' => 'ImageController@getImage'));

Route::post('/media/moveimage', array('as' => 'move_image', 'uses' => 'ImageController@postMove'));

Route::get('/albums/{id}', array('as' => 'indi','uses' => 'ImageController@indiImage'));


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
