@extends('layouts/app')

@section('content')
<div class="container">
	<h1 class="card-header text-center"><span style="font-size:22px;"><a href="{{url('/books')}} " style="text-decoration: none;">&larr;books</a></span> Authors</h1>
	<div class="card-body">
		
		@forelse($authors as $author)
		<h4>
		<li >
			
			{{ $author->name }}	 {{ $author->dob?$author->dob->format('d-m-Y'):''  }}		
		</li>
		</h4>
		@empty
		<h4 class="card-header mg-top-15">No authors yet</h4>
		@endforelse
	</div>
</div>
@endsection