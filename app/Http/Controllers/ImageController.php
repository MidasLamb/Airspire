<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Image;

class ImageController extends Controller
{
  public function getForm($id)
  {
    PagesController::fillData();
    $data = PagesController::getData();

    $data['album'] = Album::find($id);
    return view('pages/media/addimage')
    ->with($data);
  }

  public function postAdd()
  {
    $rules = array(

      'album_id' => 'required|numeric|exists:albums,id',
      'images'=>'required'

    );

    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('add_image',array('id' =>Input::get('album_id')))
      ->withErrors($validator)
      ->withInput();
    }

    foreach(Input::file('images') as $file){
      $random_name = str_random(8);
      $destinationPath = 'albums/';
      $extension = $file->getClientOriginalExtension();
      $filename=$random_name.'_album_image.'.$extension;
      $uploadSuccess = $file->move($destinationPath, $filename);
      Image::create(array(
        'description' => Input::get('description'),
        'image' => $filename,
        'album_id'=> Input::get('album_id')
      ));
    }
    return Redirect::route('show_album',array('id'=>Input::get('album_id')));
  }
  public function getDelete($id)
  {
    $image = Image::find($id);
    $image->delete();
    return Redirect::route('show_album',array('id'=>$image->album_id));
  }

  public function postMove()
  {
    $rules = array(

      'new_album' => 'required|numeric|exists:albums,id',
      'photo'=>'required|numeric|exists:images,id'

    );

    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('index');
    }
    $image = Image::find(Input::get('photo'));
    $image->album_id = Input::get('new_album');
    $image->save();
    return Redirect::route('show_album',array('id'=>Input::get('new_album')));
  }
}
