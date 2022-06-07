@extends('layouts/app')


@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header">Add Author</h1>
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
		<form method="POST" action="{{ url('authors')}}" style="margin: 10px;">
			@csrf

		<div>
			<input type="text" class="form-control" name="name" placeholder="book author">
		</div>
		
		<div>
			<input type="date" class="form-control" name="dob" max="{{ $now }}">
		</div>
		<div>
			<button type="submit" class="btn">Submit</button>

		</div>
		</form>
		<a href="{{url('authors')}}" style="margin: 20px; "><input type="button" style="background-color:skyblue;" value="&larr;Authors"></a>
	</div>
</div>

@endsection