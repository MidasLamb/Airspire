@extends('app')


{{--*/ $title = 'Media' /*--}}

@section('active-media')
  "active"
@stop

@section('content')

  @if ($is_dev)

    <a href="{{URL::route('create_album_form')}}" class="btn btn-big btn-default">Create New Album</a>

  @endif
  <div class="row">
    @foreach($albums as $album)
    <a href="{{URL::route('show_album',array('id'=>$album->id))}}">
      <div class="col-lg-3">
        <div class="thumbnail">
          <img alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
          <div class="caption">
            <h3>{{$album->name}}</h3>
            <p>{{$album->description}}</p>
            <p>{{count($album->Photos)}} image(s).</p>
            @if($is_dev)
              <p>Created date:  {{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</p>
            @endif
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
@stop
