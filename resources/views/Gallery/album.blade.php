<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{$album->name}}</title>
  <!-- Latest compiled and minified CSS -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled and minified JavaScript -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
  <style>
    body {
      padding-top: 50px;
    }

    .starter-template {
      padding: 40px 15px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="starter-template">
      <div class="media">
        <img class="media-object pull-left img-circle img-responsive thumbnail" alt="{{$album->name}}"
          src="/albums/{{$album->cover_image}}" width="150" height="150">
        <div class="media-body">
          <h2 class="media-heading" style="font-size: 18px;">Album Name:</h2>
          <p>{{$album->name}}</p>
          <div class="media">
            <h2 class="media-heading" style="font-size: 18px;">Album Description :</h2>
            <p>{{$album->description}}</p>
            <a href="{{URL::route('add_image',array('id'=>$album->id))}}">
              <button type="button" class="btn btn-primary btn-medium">New Image to Album</button>
            </a>
            <a href="{{URL::route('delete_album',array('id'=>$album->id))}}" onclick="return confirm('Are you sure?')">
              <button type="button" class="btn btn-danger btn-medium">Delete
                Album
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      
      @foreach($album->Photos as $photo)
      <div class="col-lg-3">
        <div class="thumbnail" style="max-height: 350px; min-height: 350px;">
          <img alt="{{$album->name}}" src="/albums/{{$photo->image}}">
          <div class="caption">
            <p><strong>{{$photo->description}}</strong></p>
            <p>
              <p>Created date: {{ date("d F Y",strtotime($photo->created_at)) }} at
                {{ date("g:ha",strtotime($photo->created_at)) }}</p>
            </p>
            <a href="{{URL::route('delete_image',array('id'=>$photo->id))}}" onclick="return confirm('Are you sure?')">
              <button type="button" class="btn btn-danger btn-small">Delete
                Image
              </button>
            </a>
            
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</body>

</html>