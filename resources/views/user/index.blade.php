@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"> Users</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
       
        <form action="/search" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group" style="float: right">
            <input type="text" class="form-control" name="q" placeholder="Search users"> <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <span class="fas fa-search "></span>
              </button>
            </span>
          </div>
        </form>
        <div class="container">
          @if(isset($details))
              <p> The Search results for your query <b> {{ $query }} </b> are :</p>
          <h2>Sample User details</h2>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($details as $user)
                  <tr>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          @endif
      </div>
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">Users List</div>
          
            <div class="card-body">
              <table class="container-fluid table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch"
                        {{ $user->status == 1 ? 'checked' : '' }}>
                    </td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<script>
  let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('users.update.status') }}',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
        });
    });
});

</script>
@endsection

{{-- <h1>user page</h1>
<a href="{{ route('admin.home')}}">back</a> --}}