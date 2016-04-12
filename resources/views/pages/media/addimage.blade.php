@extends('app')

@section('active-media')
  "active"
@stop


{{--*/ $title = 'Album' /*--}}

@section('content')
      <div class="span4" style="display: inline-block;margin-top:100px;">
        @if($errors->has())
          <div class="alert alert-block alert-error fade in"id="error-block">
            <?php
            $messages = $errors->all('<li>:message</li>');
            ?>
            <button type="button" class="close"data-dismiss="alert">×</button>

            <h4>Warning!</h4>
            <ul>
              @foreach($messages as $message)
                {{$message}}
              @endforeach

            </ul>
          </div>
        @endif
        <form name="addimagetoalbum" method="POST"action="{{URL::route('add_image_to_album')}}"enctype="multipart/form-data">
          {!! Form::open(array('url' => URL::route('add_image_to_album'), 'files'=>true)) !!}
          <input type="hidden" name="album_id"value="{{$album->id}}" />
          <fieldset>
            <legend>Add an Image to {{$album->name}}</legend>
            <div class="form-group">
              <label for="description">Image Description</label>
              <textarea name="description" type="text"class="form-control" placeholder="Imagedescription"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Select an Image</label>
              {!! Form::file('images[]', array('multiple'=>true)) !!}
            </div>
            <button type="submit" class="btnbtn-default">Add Image!</button>
          </fieldset>
          {!! Form::close() !!}
        </form>
      </div>
@stop
