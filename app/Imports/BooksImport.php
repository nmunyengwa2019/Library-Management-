<?php

namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Book;
use App\Models\Author;
use Maatwebsite\Excel\Concerns\ToCollection;

class BooksImport implements ToCollection
{
    use Importable;
    public function Collection(Collection $rows)
    {
       foreach ($rows as $row) {
        $author=Author::firstOrCreate([
            'name'=>$row[1],
            'dob'=>$row[3]
           ]);

           $author->books()->firstOrCreate([
            'name'=>$row[0],
            
            'published_at'=>$row[2]
           ]);

           
       }
    }
}
