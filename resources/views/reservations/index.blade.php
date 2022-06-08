@extends('layouts/app')

@section('content')
<div class="container ">

	<div class="card">
		<h2 class="card-header text-center"><span style="font-size:x-small;"><a href="{{url('/books')}} " style="text-decoration:none;">&larr;all books</a></span> Borrowed books [{{$total}}] </h2>
		<div class="card-body">
			<ol>
				@forelse($books as $book)
				<li>
					<h4>{{$book->book_id}}  </h4>
					
					<h6 style="color:dimgrey;">Borrowed on {{$book->checked_out_at}}<br> by {{$users->find($book->user_id)->name;}}</h6>
				
					<div class="text-center">
						<form method="POST" action="{{url('/checkin/'.$book->book_id)}}">
							@csrf
							<button type="submit">Checkin</button>
						</form>
					</div>
				</li>
				<hr>
				@empty
				<h5>Empty</h5>
				@endforelse
			</ol>
		</div>
		
	</div>
</div>
@endsection