@extends('layouts/app')

@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header text-center">Books [{{$total}}]</h1>
		<a href="{{ url('books/create')}}" style="text-align: center; margin-top: 15px;"> <input type="button" style="background-color: skyblue;" value="Add book "></a>
		<div class="card-body">
			<ol>
			

			@forelse($books as $book)
			<li class="card-body">
				<h5>{{$book->name}} <a href="{{ url($book->path().'/edit')}}" style="text-align: right; margin-top: 15px; font-size: x-small;"> <input type="button" style="background-color: skyblue;" value="Edit"></a></h5> <span style="color:dimgrey;">published by {{$book->author->name}}  </span>{{$book->published_at->format('d-m-Y')}}

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