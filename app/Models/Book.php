<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates=['published_at'];

    public function setPublishedDate($published)
    {
        $this->$attributes['published_at']=Carbon::createFromDate(config('app.date_format'),$published)->format('dd-mm-yyyy');
    }

    public function path()
    {
        return '/books/'.$this->id;
    }

    public function setAuthorIdAttributes($author)
    {
        $this->$attributes['author_id'] = Author::firstOrCreate([
            'name'=>$author
        ])->id; 
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
