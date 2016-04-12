@extends('app')

@section('active-media')
  "active"
@stop


{{--*/ $title = 'Image' /*--}}

@section('content')







            <img alt="{{ $photo }}" src="/albums/{{ $photo }}" style="max-width: 100%;">
            <div class="caption">
              <p>{{ $photo }}</p>
                @if($isDev)
                <a href="{{URL::route('delete_image',array('id'=>$photo['id']))}}" onclick="return confirm('Are you sure?')"><button type="button"class="btn btn-danger btn-small">Delete Image</button></a>

                @endif
              </form>
            </div>




@stop
