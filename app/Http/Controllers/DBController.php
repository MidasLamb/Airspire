<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DBController extends Controller
{
  public function store(Request $request){

    echo $request->input('name');


  }
}
