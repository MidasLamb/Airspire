<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Album;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AlbumsController extends Controller
{

  public function getList()
  {
    PagesController::fillData();
    $data = PagesController::getData();

    $data['albums'] = Album::with('Photos')->get();
    return view('pages/media/index')
    ->with($data);
  }
  public function getAlbum($id)
  {
    PagesController::fillData();
    $data = PagesController::getData();

    $album = Album::with('Photos')->find($id);
    $albumsMod = Album::where('id', '<>', $id)->get();
    $others = $albumsMod->toArray();
    $data = array_merge($data, $album->toArray());
    $data['albums'] = $others;
    return view('pages/media/album')
    ->with($data);
  }
  public function getForm()
  {
    PagesController::fillData();
    $data = PagesController::getData();

    return view('pages/media/createalbum')->with($data);
  }
  public function postCreate()
  {
    $rules = array(

      'name' => 'required',
      'cover_image'=>'required|image'

    );

    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('create_album_form')
      ->withErrors($validator)
      ->withInput();
    }

    $file = Input::file('cover_image');
    $random_name = str_random(8);
    $destinationPath = 'albums/';
    $extension = $file->getClientOriginalExtension();
    $filename=$random_name.'_cover.'.$extension;
    $uploadSuccess = Input::file('cover_image')
    ->move($destinationPath, $filename);
    $album = Album::create(array(
      'name' => Input::get('name'),
      'description' => Input::get('description'),
      'cover_image' => $filename,
    ));

    return Redirect::route('show_album',array('id'=>$album->id));
  }

  public function getDelete($id)
  {
    $album = Album::find($id);

    $album->delete();

    return Redirect::route('index');
  }
}
