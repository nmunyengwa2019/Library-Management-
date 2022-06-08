@extends('layouts/app')

@section('content')
<div class="container">
	<div class="card-body">
		<div class="card-header">
			<h1>Edit a book</h1>
		</div>
		<form method="POST" action="{{ url($book->path())}}">
			@csrf
			@method('patch')

		<div>
			<input type="text" class="form-control" value="{{$book->name}}" name="name" placeholder="book name">
		</div>
		<div>
			<input type="text" class="form-control" value="{{$book->author_id}}" name="author_id" placeholder="Author">
		</div>
		<div>
			<input type="date" class="form-control"  value="{{$book->name}}" name="published_at" max="{{ $now }}">
		</div>
		<div>
			<button type="submit" class="btn">Submit</button>
			<a href="{{url('/books')}}"><input type="button" value="Cancel"></a>
		</div>
		</form>

		
	</div>
</div>
@endsection