@extends('layouts/app')

@section('content')
<div class="container">
	<div class="card-body">
	<div>
		<h1 class="card-header" >{{$book->name}}</h1>

	</div>
	<div>
		<h3 class="card-header">{{$book->author_id}}</h3>

	</div>
	<h5 class="card-header">{{$book->published_at->format('d-m-Y')}}</h5>
</div>
<a href="{{url('books')}}" style="margin: 20px; "><input type="button" style="background-color:skyblue;" value="&larr;Books"></a>
</div>
@endsection