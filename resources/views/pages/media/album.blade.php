@extends('app')

@section('active-media')
  "active"
@stop


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


          <div class="thumbnail" onclick="openNav( {{ $key }})" style="max-height: 350px;">
            <img class = "image" alt="{{$name}}" src="/albums/{{$photo['image']}}" style="max-height: 150px;">
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

        </div>
        @endforeach
      </div>




<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
  <div class="overlay-content">

    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" style="width: 100%; height: 100%;">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        @foreach($photos as $key => $photo)
        <li data-slide-to="{{$key}}"
        @if($key == 0)
        class="active"
        @endif
        ></li>
        @endforeach
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox" style="width: 100%; height: 100%; margin: auto;">
        @foreach($photos as $key => $photo)
        <div class="item
          @if($key == 0)
          active
          @endif
          " id= "{{ $key }}" style="width: 100%; height: 100%;">
          <a href="{{ URL::route('show_image',array('id'=>$photo['id']))}}">
            <img alt="{{$name}}" src="/albums/{{$photo['image']}}" style= "max-width: 100%; max-height: 100%; top: 50%; left: 50%;
            transform: translate(-50%, -50%); position: absolute;">
          </a>
        </div>
        @endforeach
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>

  </div>

</div>

@stop

@section('js_script')



$(document).ready(function(){
  $("#myCarousel").on('slid.bs.carousel', function () {
        changeHash(document.getElementsByClassName("item active")[0].id );
    });


  $('.carousel-control.left').click(function() {
    $('#myCarousel').carousel('prev');
  });


  $('.carousel-control.right').click(function() {
    $('#myCarousel').carousel('next');
  });

  $('.carousel-control').click(function(event){
    event.preventDefault();
});

});

/* Open when someone clicks on the span element */
function openNav( id ) {
    changeHash(id);
    document.getElementById("myNav").style.height = "100%";
    document.getElementsByClassName("item active")[0].className = "item";
    document.getElementById(id).className = "item active";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("myNav").style.height = "0%";
    history.pushState("", document.title, window.location.pathname);
}

function changeHash(hash){
  window.location.hash = hash;

}

function incrementHash(){
  if(window.location.hash) {
    var hash = window.location.hash.substring(1);
    changeHash(document.getElementsByClassName("item active")[0].id );
  }
}

function decrementHash(){
  if(window.location.hash) {
    var hash = window.location.hash.substring(1);
    changeHash( parseInt(changeHash( document.getElementsByClassName("item active")[0].id )) - 1);
  }
}


@stop

@section('end_js')
if(window.location.hash) {
  var hash = window.location.hash.substring(1);
  openNav(hash);
}
@stop


@section('css')
html, body { height: 100%; }

.image:hover {
  cursor: pointer;
  cursor: hand;
}

/* The Overlay (background) */
.overlay {
    /* Height & width depends on how you want to reveal the overlay (see JS below) */
    height: 0;
    width: 100%;
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    background-color: rgb(0,0,0); /* Black fallback color */
    background-color: rgba(0,0,0, 0.9); /* Black w/opacity */
    overflow-x: hidden; /* Disable horizontal scroll */
    transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
}

/* Position the content inside the overlay */
.overlay-content {
    overflow: hidden;
    position: relative;


    max-width: 100%; /* 100% width */
    height: 100%;

    margin: auto;
    text-align: center; /* Centered text/links */
}



/* When you mouse over the navigation links, change their color */
.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

/* Position the close button (top right corner) */
.closebtn {
    position: absolute;
    z-index:100;
    top: 20px;
    right: 45px;
    font-size: 60px !important; /* Override the font-size specified earlier (36px) for all navigation links */
}

@stop
