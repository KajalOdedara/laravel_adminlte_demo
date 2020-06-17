@extends('layouts.admin')

@section('content')

  <div class="container" style="text-align: center;">
    <div class="span4" style="display: inline-block;margin-top:100px;">
      @if($errors->any())
      <div class="alert alert-block alert-error fade in" id="error-block">
        <?php
            $messages = $errors->all('<li>:message</li>');
            ?>
        <button type="button" class="close" data-dismiss="alert">×</button>

        <h4>Warning!</h4>
        <ul>
          @foreach($messages as $message)
          {{$message}}
          @endforeach

        </ul>
      </div>
      @endif
      <form name="addimagetoalbum" method="POST" action="{{URL::route('add_image_to_album')}}"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="album_id" value="{{$album->id}}" />
        <fieldset>
          <legend>Add an Image to {{$album->name}}</legend>
          <div class="form-group">
            <label for="description">Image Description</label>
            <textarea name="description" type="text" class="form-control" placeholder="Image description"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Select an Image</label>
            {{Form::file('image')}}
          </div>
          <button type="submit" class="btn btn-success">Add Image!</button>
        </fieldset>
      </form>
    </div>
  </div> <!-- /container -->

@endsection