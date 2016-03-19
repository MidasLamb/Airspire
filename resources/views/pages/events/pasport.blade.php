@extends('app')

{{--*/ $title = 'Pasport' /*--}}

@section('fb_functions')

@stop

@section('js_script')

@stop

@section('active-pasport')
  "active"
@stop

@section('content')
  <div>
    <h1>Jouw Paspoort</h1>
  </div>
  <div class="row">
    @foreach($events as $event)
      <a href="{{URL::route('event',array('id'=>$event->id))}}">
        <div class="col-lg-4">
          <div class="thumbnail">
            <div>
              <img alt="Flag of {{$event->country_name}}" src="/flags/{{$event->country_flag}}" style="width: 200px; position: relative; margin-left: 30px; margin-top: 10px;">

              @if(in_array($event->id, $evats))
                <img alt="Flag of {{$event->country_name}}" src="/flags/stamps.png" style="width: 200px; position: absolute; top: 15px; left: 50px;">
              @endif
            </div>
            <div style="margin-left: 30px;">
              <h3>{{ $event->title }}</h3>
              {{ $event->excerpt }}
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
@stop
