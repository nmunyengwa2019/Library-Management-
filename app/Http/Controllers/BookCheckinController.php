<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookCheckinController extends Controller
{
    public function store(Book $book)
    {
        $book->checkin(auth()->user());

    }
}
