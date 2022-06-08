<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use App\Models\Reservations;
use Illuminate\Http\Request;

class BookCheckoutController extends Controller
{
    public function store(Book $book)
    {
        $book->checkout(auth()->user());

        return redirect('/checkedout/books');

    }

    public function index()
    {
        $books= Reservations::all();
        $total=$books->count()?$books->count():0;
        $users = User::all();


        return view('reservations/index',compact(['books','users','total']));
    }
}
