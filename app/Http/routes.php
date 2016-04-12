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



  if(PagesController::isValidAccessToken()) {
      $response = PagesController::getFBUser();
      $data['loggedin'] = true;
  } else {
      $data['loggedin'] = false;
  }

  return view('dev')->with($data);
});

Route::get('ban', function(){
  return view('pages/ban');
});

//Info pages -------------------------------------------------------

Route::get('/','PagesController@welcome');

Route::get('home', 'PagesController@home');

Route::get('aboutus', 'PagesController@aboutus');

Route::get('booth', 'PagesController@booth');

Route::get('playthatcard', 'PagesController@playThatCard');

//Events --------------------------------------------------------------

Route::get('events', 'EventsController@events');
Route::get('events/{id}', array('as' => 'event','uses' =>'EventsController@event'));

//Pasport --------------------------------------------------------------

Route::get('pasport', 'EventsController@pasport');

//Login ------------------------------------------------------------

Route::get('login/{page}', 'AuthController@login')->where('page', '(.*)');
Route::post('login/{page}', 'AuthController@loginPost')->where('page', '(.*)');
//
//Route::get('loginFallback', 'AuthController@loginFallback');

Route::get('logout/{page}', 'AuthController@logout')->where('page', '(.*)');



//QR Code --------------------------------------------------------------

Route::get('QRCode', 'PagesController@QRCode');
Route::get('QRCode/dev', array('as' => 'DevQRCode','uses' => 'PagesController@devQRCode'))->middleware(['auth.dev']);
Route::get('QRCode/{id}', 'PagesController@developQRCode')->middleware(['auth.dev']);

Route::post('eventattendeces',['middleware' => 'auth.quick', 'uses' => 'DBController@store']);


Route::get('events/{hash}/{time}', 'EventsController@eventAttendence');


//Albums ---------------------------------------------------------------
Route::get('/media', array('as' => 'index','uses' => 'AlbumsController@getList'));
Route::get('/media/createalbum', array('as' => 'create_album_form','uses' => 'AlbumsController@getForm'))->middleware(['auth.dev']);
Route::post('/media/createalbum', array('as' => 'create_album','uses' => 'AlbumsController@postCreate'))->middleware(['auth.dev']);
Route::get('/media/deletealbum/{id}', array('as' => 'delete_album','uses' => 'AlbumsController@getDelete'))->middleware(['auth.dev']);
Route::get('/media/album/{id}', array('as' => 'show_album','uses' => 'AlbumsController@getAlbum'));

Route::get('/media/addimage/{id}', array('as' => 'add_image','uses' => 'ImageController@getForm'))->middleware(['auth.dev']);
Route::post('/media/addimage', array('as' => 'add_image_to_album','uses' => 'ImageController@postAdd'))->middleware(['auth.dev']);
Route::get('/media/deleteimage/{id}', array('as' => 'delete_image','uses' => 'ImageController@getDelete'))->middleware(['auth.dev']);
Route::get('/media/image/{id}', array('as' => 'show_image','uses' => 'ImageController@getImage'));

Route::post('/media/moveimage', array('as' => 'move_image', 'uses' => 'ImageController@postMove'))->middleware(['auth.dev']);

Route::get('/albums/{id}', array('as' => 'indi','uses' => 'ImageController@indiImage'));


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Leftovers:
Route::get('{page}', function($page){
  $tr = true;
  Log::alert('Non-existing page acces: '.$page);
  return redirect('home')->with('page_acc', $tr);
})->where('page', '(.*)');
