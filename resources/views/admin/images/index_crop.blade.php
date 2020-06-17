@extends('layouts.admin')
@section('content')

<body>
  <div class="container">
    <div class="card">
      <div class="card-header">Crop and Upload Image</div>
      <div class="card-body">
        <div class="form-group">
          @csrf
          <div class="row">
            <div class="col-md-4" style="border-right:1px solid #ddd;">
              <div id="image-preview"></div>
            </div>
            <div class="col-md-4" style="padding:75px; border-right:1px solid #ddd;">
              <p><label>Select Image</label></p>
              <input type="file" name="upload_image" id="upload_image" />
              <br />
              <br />
              <button class="btn btn-success crop_image">Crop & Upload Image</button>
            </div>
            <div class="col-md-4" style="padding:75px;background-color: #333">
              <div id="uploaded_image" align="center"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <br />
    <br />
    <br />
  </div>
</body>
<script>
  $(document).ready(function(){
  $image_crop = $('#image-preview').croppie({
    enableExif:true,
    viewport:{
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });
  $('#upload_image').change(function(){
    var reader = new FileReader();
    reader.onload = function(event){
      $image_crop.croppie('bind', {
        url:event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });
  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      var _token = $('input[name=_token]').val();
      $.ajax({
        url:'{{ route("image_crop.upload") }}',
        type:'post',
        data:{"image":response, _token:_token},
        dataType:"json",
        success:function(data)
        {
          var crop_image = '<img src="'+data.path+'" />';
          $('#uploaded_image').html(crop_image);
        }
      });
    });
  });
});  
</script>
@endsection