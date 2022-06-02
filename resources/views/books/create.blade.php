@extends('layouts/app')


@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header">Add Book</h1>
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
		<form method="POST" action="{{ url('books')}}">
			@csrf

		<div>
			<input type="text" class="form-control" name="name" placeholder="book name">
		</div>
		<div>
			<input type="text" class="form-control" name="author_id" placeholder="Author">
		</div>
		<div>
			<input type="date" class="form-control" name="published_at" max="{{ $now }}">
		</div>
		<div>
			<button type="submit" class="btn">Submit</button>
		</div>
		</form>
	</div>
</div>

@endsection