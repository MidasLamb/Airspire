@extends('app')


{{--*/ $title = 'Album' /*--}}

@section('content')

      <div class="starter-template">
        <div class="media">
          <img class="media-object pull-left"alt="{{$name}}" src="/albums/{{$cover_image}}" style="max-width: 350px; padding-bottom: 10px;">
          <div class="media-body">
            <h2 class="media-heading" style="font-size: 26px;">Album Name:</h2>
            <p>{{$name}}</p>
          <div class="media">
            <h2 class="media-heading" style="font-size: 26px;">AlbumDescription :</h2>
            <p>{{$description}}<p>
            @if($isDev)
              <a href="{{URL::route('add_image',array('id'=>$id))}}"><button type="button"class="btn btn-primary btn-large">Add New Image to Album</button></a>
              <a href="{{URL::route('delete_album',array('id'=>$id))}}" onclick="return confirm('Are you sure?')"><button type="button"class="btn btn-danger btn-large">Delete Album</button></a>
            @endif
          </div>
        </div>
      </div>
    </div>
      <div class="row">
        @foreach($photos as $key => $photo)
        <div class="col-lg-4">
          <a href="{{ URL::route('show_image',array('id'=>$photo['id']))}}">
          <div class="thumbnail" style="max-height: 350px;">
            <img alt="{{$name}}" src="/albums/{{$photo['image']}}" style="max-height: 150px;">
            <div class="caption">
              <p>{{$photo['description']}}</p>
              <p>Created date:  {{ date("d F Y",strtotime($photo['created_at'])) }} at {{ date("g:ha",strtotime($photo['created_at'])) }}</p>
              @if($isDev)
                <a href="{{URL::route('delete_image',array('id'=>$photo['id']))}}" onclick="return confirm('Are you sure?')"><button type="button"class="btn btn-danger btn-small">Delete Image</button></a>
                <p>Move image to another Album :</p>
                <form name="movephoto" method="POST"action="{{URL::route('move_image')}}">
                  {!! Form::open(array('url' => URL::route('move_image'))) !!}
                  <select name="new_album">
                    @foreach($albums as $others)
                      <option value="{{$others['id']}}">{{$others['name']}}</option>
                    @endforeach
                  </select>
                  <input type="hidden" name="photo" value="{{$photo['id']}}" />
                  <button type="submit" class="btn btn-smallbtn-info" onclick="return confirm('Are you sure?')">Move Image</button>
                @endif
              </form>
            </div>
          </div>
          </a>
        </div>
        @endforeach
      </div>



    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @foreach($photos as $key => $photo)
    <li data-target="#carousel-example-generic" data-slide-to="{{$key}}"
    @if($key == 0)
    class="active"
    @endif
    ></li>
    @endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($photos as $key => $photo)
    <div class="item
    @if($key == 0)
    active
    @endif
    " id= "{{ $key }}">
    <a href="{{ URL::route('show_image',array('id'=>$photo['id']))}}">
      <img alt="{{$name}}" src="/albums/{{$photo['image']}}">
    </a>
    </div>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@stop
