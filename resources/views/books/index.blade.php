@extends('layouts/app')

@section('content')
<div class="container">
	<div class="card">
		<h1 class="card-header text-center">Books [{{$total}}] 

			<span style="font-size:22px;">&rarr;<a href="{{ url('checkedout/books')}} " style="text-decoration: none;">Borrowed books</a></span>
		</h1>

		<a href="{{ url('books/create')}}" style="text-align: center; margin-top: 15px;"> <input type="button" style="background-color: skyblue;" value="Add book "></a>

		<a href="{{url('/authors')}} " style="text-align: center; margin-top: 15px;"> <input type="button" style="background-color: skyblue;" value="Authors"></a>
		<div class="card-body">
			<ol>
			

			@forelse($books as $book)
			<li class="card-body">

				<h5>{{$book->name}} 
					<a href="{{ url($book->path().'/edit')}}" style="text-align: right; margin-top: 15px; font-size: x-small;"> <input type="button" style="background-color: skyblue;" value="Edit">
					</a>


				</h5> 

				<span style="color:dimgrey;">published by
					{{$name =$book->author?$book->author->name:'unknown';}}


				</span>{{$book->published_at->format('d-m-Y')}}

				<div>
					<form method="POST" action="{{url($book->path())}}">
						@csrf
						@method('DELETE')
						<button  type="submit" >Delete</button>
					</form>
				</div>
				<div class="text-center bg-blue">
					<form method="POST" action="{{url('/checkout/'.$book->id)}}">
						@csrf
						
						<button  type="submit" >Check-out book</button>
					</form>
				</div>

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