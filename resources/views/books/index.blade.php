@extends('layouts/app')

@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header">Books [{{$total}}]</h1>
		<div class="card-body">
			<ol>
			

			@forelse($books as $book)
			<li class="card-body">
				<h5>{{$book->name}} <span style="font-size: x-small;"></span></h5> published {{$book->published_at->format('d-m-Y')}}
			</li>
			<hr>
			@empty
			<h2>Library is empty</h2>
			@endforelse
			
		</ol>
		</div>
	</div>
</div>

@endsection