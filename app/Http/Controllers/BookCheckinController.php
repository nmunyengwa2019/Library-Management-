<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Reservations;
use Illuminate\Http\Request;

class BookCheckinController extends Controller
{
    public function store(Book $book)
    {
        $res = Reservations::find($book->id);
        
        if (auth()->user()->id!= $res->user_id) {
            
            return redirect('checkedout/books');
        }
        try{
        $book->checkin(auth()->user());
        $res->delete();
            }
        catch(\Exception $e){
            return response([],404);
        }

        return redirect('/books');

    }
}
