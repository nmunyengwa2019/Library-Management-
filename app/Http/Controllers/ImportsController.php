<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;
use Illuminate\Http\Request;

class ImportsController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('file');
        
        (new BooksImport)->Import($path);

        return redirect('books')->withStatus('file imported successfully');
    }
}
