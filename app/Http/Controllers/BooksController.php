<?php

namespace App\Http\Controllers;

use Illuminate\view\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Carbon\Carbon;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        $total=$books->count()?$books->count():0;
        return view('books/index',compact(['books','total']
    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now =new Carbon();
        return view('books/create',compact('now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes= request()->validate([
                "name"=>"required",
                "author_id"=>"required",
                "published_at"=>"required",
            ]);
        Book::firstOrCreate($attributes);
        Author::firstOrCreate(['name'=>$attributes['author_id']]);
        return redirect('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        return view('books/show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $now =new Carbon();
        return view('books/edit',compact(['book','now']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book)
    {
        $attributes= request()->validate([
                "name"=>"required",
                "author_id"=>"required",
                "published_at"=>"required",
            ]);
        //dd($book->update($attributes));

        $book->update($attributes);
        return redirect($book->path());   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }

    
}
