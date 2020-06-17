@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">News</h1>
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
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary" data-toggle="popover"
          title="Add new news via this button" data-content="Some content inside the popover">
          Add New News
        </a>
        <a href="{{ route('exportexcel') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top"
          title="Download Now">
          Excel
        </a>
        <a href="{{ route('exportcsv') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top"
          title="Download Now">
          CSV
        </a>
        {{-- <a href="{{ route('exportpdf') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top"
          title="Download Now">
          PDF
        </a> --}}
        {{-- model start --}}

        {{-- modal ends --}}
      </p>
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-3 mb-4">

          <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 amber-border" type="text" id="search" name="search"
              placeholder="typeahead Search" aria-label="Search">
            <div class="input-group-append">
              <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                  aria-hidden="true"></i></span>
            </div>
          </div>

        </div>
        <!--Grid column-->
        <form action="/search" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search users"> <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <span class="fas fa-search"></span>
              </button>
            </span>
          </div>
        </form>
        <hr>
        <a href="news/?category_id=5">Bird | </a>
        <a href="news/?category_id=1"> animal | </a>
        <a href="news/">Reset</a>


      </div>
      <!--Grid row-->

      <script type="text/javascript">
        var path = "{{ url('search') }}";
        $('#search').typeahead({
            minLength: 1,
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
      </script>
      <table id="news-table" class="container-fluid table table-striped table-bordered">
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
  {{-- <script>
    let table = $('#news-table')({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    ordering: false,
    processing: true,
    language: {
      processing: '<span>Processing</span>',
    },
    serverSide: true,
    ajax: {
      url: '{{ route('admin.news.index')}}',
  method: 'get',
  // data: function (d) {
  // d.start_date = $('#start-date').val();
  // d.end_date = $('#end-date').val();
  // }
  },
  search: {
  caseInsensitive: false,
  },
  columns: [
  {data: 'id'},
  {data: 'title'},
  {data: 'description'},
  {data: 'Author'},
  {data: 'category_id'},
  ],
  });
  </script> --}}

</section>

@endsection