@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Add News</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.home') }}>Dashboard</a></li>
					<li class="breadcrumb-item active">Add News</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Title</label>
					<div class="col-md-6">
						<input type="text" name="title" class="form-control" required>
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">category</label>
					<div class="col-md-6">
						<select name="category_id" class="form-group">
						<option value="">Choose category
						</option>
						@foreach($categories as $c)
								<option value="{{ $c->id }}">{{ $c->title }}
						</option>
						@endforeach
						</select>
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>


			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Image</label>
					<div class="col-md-6"><input type="file" name="image" required>
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Description</label>
					<div class="col-md-6">
						<textarea name="description" id="des" class="form-control" cols="30" rows="10"></textarea>
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Author</label>
					<div class="col-md-6">
						<input type="text" name="author" class="form-control" required>
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-info" value="Save">
				<a href="{{ url('/admin/news') }}" class="btn btn-info">cancle</a>
			</div>
		</form>
	</div>
</section>
@endsection