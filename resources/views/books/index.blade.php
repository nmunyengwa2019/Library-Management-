@extends('layouts/app')

@section('content')
<div>
	<div>
		<h1>Books</h1>
		<div>
			<ul>
			@forelse($books as $book)
			<li>
				{{$book->name}}
				<!-- <li>{{$book->author}}</li> -->
				<li>{{$book->published_at}}</li>
			</li>
			@empty
			<h2>Library is empty</h2>
			@endforelse
			</ul>
		</div>
	</div>
</div>

@endsection