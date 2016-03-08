@extends('app')


{{--*/ $title = 'Media' /*--}}

@section('content')

        <div class="row">
          @foreach($albums as $album)
            <div class="col-lg-3">
              <div class="thumbnail" style="min-height: 514px;">
                <img alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
                <div class="caption">
                  <h3>{{$album->name}}</h3>
                  <p>{{$album->description}}</p>
                  <p>{{count($album->Photos)}} image(s).</p>
                  <p>Created date:  {{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</p>
                  <p><a href="{{URL::route('show_album',array('id'=>$album->id))}}" class="btn btn-big btn-default">Show Gallery</a></p>
                </div>
              </div>
            </div>
          @endforeach
          @if (count($albums) === 0)
            <a href="{{URL::route('create_album_form')}}">Create New Album</a>
          @endif
        </div>

@stop
