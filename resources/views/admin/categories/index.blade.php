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
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-3 mb-4">

          <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 amber-border" type="text" id="search" name="search"
              placeholder="Typeahead Search" aria-label="Search">
            <div class="input-group-append">
              <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                  aria-hidden="true"></i></span>
            </div>
          </div>
        </div>
        <!--Grid column-->
        <form action="{{ route('admin.searchoption') }}" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group" style="float: right">
            <input type="text" class="form-control" name="q" placeholder="pagination Search category"> <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <span class="fas fa-search "></span>
              </button>
            </span>
          </div>
        </form>
      </div>
      <!--Grid row-->



      <div>

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
      <div class="container-fluid">
        <div class="row mb-2 float-sm-right">
          {{ $categories->links() }}
        </div>
      </div>
      @if (session('status'))
      <div class="alert alert-success col-md-6 float align-text-bottom">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>

  <script type="text/javascript">
    var path = "{{ url('categorysearch') }}";
    $('#search').typeahead({
        minLength: 1,
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
  </script>
</section>
@endsection