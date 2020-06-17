@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Gallery</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"> Gallery</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

{{-- <table class="container-fluid table table-striped table-bordered">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Action</th>
  </tr>
  @foreach ($albums as $album)
  <tr>
    <td>{{$c->id}}</td>
    <td>{{$c->title}}</td>
    <td><a href="{{ route('admin.categories.edit',$c->id) }}" class="btn btn-info">edit</a>

      <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
        class="btn btn-danger">delete</a>

      <form action="{{ route('admin.categories.destroy',$c->id) }}" method="post">@method('DELETE')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
    </td>
  </tr>
  @endforeach
</table> --}}
  <ul class="nav navbar-nav">
    <li><a href="{{URL::route('create_album_form')}}" class="btn btn-primary" style="margin: 15px;">Create New Album</a>
    </li>
  </ul>

  <div class="container">

    <div class="starter-template">

      <div class="row">
        @foreach($albums as $album)
        <div class="col-lg-3">
          <div class="thumbnail" style="min-height: 500px;">
            <img class="img-circle img-thumbnail" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" width="200px";>
            <div class="caption">
              <h3>{{$album->name}}</h3>
              <p>{{$album->description}}</p>
              <p>{{count($album->Photos)}} image(s)</p>
              <p><B>Created date: </B>{{ date("d F Y",strtotime($album->created_at)) }} at
                {{date("g:ha",strtotime($album->created_at)) }}</p>
              <p><a href="{{URL::route('show_album',array('id'=>$album->id))}}" class="btn btn-big
              btn-default">Show Gallery</a></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>

  @endsection