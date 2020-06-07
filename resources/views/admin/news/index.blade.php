@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">News</h1>
        <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">Toggle popover</a>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"> News</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="content">
    <div class="container-fluid">
      <p>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
          Add New News
        </a>
        {{-- model start --}}
        
        {{-- modal ends --}}
      </p>
      <table class="container-fluid table table-striped table-bordered">
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>description</th>
          <th>Author</th>
          <th>Image </th>
          <th>Category </th>
          <th>Action</th>
        </tr>
        @if (count($news))
        @foreach ($news as $n)
        <tr>
          <td>{{$n->id}}</td>
          <td>{{$n->title}}</td>
          <td>{{$n->description}}</td>
          <td>{{$n->author}}</td>
          <td> <img src="{{ asset('public/news/' . $n->image) }}" style="width:150px;"> </td>
          <td>@if($n->category)
              {{$n->category->title}}
              @endif
          </td>
          <td><a href="{{ route('admin.news.edit',$n->id) }}" class="btn btn-info">edit</a>

            <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
              class="btn btn-danger">delete</a>

            <form action="{{ route('admin.news.destroy',$n->id) }}" method="post">@method('DELETE')
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="5">No News Feed</td>
        </tr>
        @endif
      </table>
  
          
            <div class="container-fluid">
            <div class="row mb-2 float-sm-right">
          {{ $news->render() }} 
          </div>
          </div>
      @if (session('status'))
      <div class="alert alert-success col-md-6 float align-text-bottom">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>
</section>
@endsection
