@extends('layouts/app')

@section('content')
<div class="container">
	<h1 class="card-header">Authors</h1>
	<div class="card-body">
		
		@forelse($authors as $author)
		<h4>
		<li >
			
			{{ $author->name }}	&rarr;  born {{ $author->dob->format('d-m-Y')  }}		
		</li>
		</h4>
		@empty
		<h4 class="card-header mg-top-15">No authors yet</h4>
		@endforelse
	</div>
</div>
@endsection