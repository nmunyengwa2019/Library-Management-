@extends('layouts/app')


@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header text-center">Add Book</h1>
	</div>
	@if($errors->any())
	<div class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>
	{{ $error}}
	</li>
	@endforeach
</div> 
	@endif
	<div class="card-body">
		<form method="POST" action="{{ url('books')}}" style="margin: 10px;">
			@csrf

		<div>
			<input type="text" aria-label="default input example" style="margin: 10px;" class="form-control" name="name" placeholder="book name">
		</div>
		<div>
			<input type="text"aria-label="default input example" style="margin: 10px;" class="form-control" name="author_id" placeholder="Author">
		</div>
		<div>
			<input type="date" style="margin: 10px;" class="form-control" name="published_at" max="{{ $now }}">
		</div>
		<div style="margin: 10px;">
			<button type="submit" class="btn btn-outline-primary">Submit</button>

		</div>
		</form>
		<h3 class="card-header">Import books as csv below</h3>

		<div class="card-body" >
			<form method="POST" action="{{url('imports')}}" enctype="multipart/form-data">
				@csrf
				<input class="form-control" style="margin: 10px;" id="formFile" type="file" name="file">
				<button type="submit" style="margin: 10px;" class="btn btn-outline-primary">Upload Data</button>
			</form>
		</div>
		<a href="{{url('books')}}" style="margin: 20px; "><input style="margin: 10px;" type="button" btn btn-outline-primary value="&larr;Books"></a>
	</div>
</div>

@endsection