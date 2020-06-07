@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Categories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"> Categories</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="content">
    <div class="container-fluid">
      <p>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
          Add category
        </a>
      </p>
      <div>
        <form class="form-inline ml-3 float-sm-right" style="">
                <div class="input-group input-group-sm">
                   <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                         <i class="fas fa-search"></i>
                        </button>
                       </div>
                 </div>
        </form>    
  </div>
      <table class="container-fluid table table-striped table-bordered">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Action</th>
        </tr>
        @foreach ($categories as $c)
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
      </table>

      @if (session('status'))
      <div class="alert alert-success col-md-6 float align-text-bottom">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>
</section>
@endsection