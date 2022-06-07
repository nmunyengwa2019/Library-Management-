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

    public function checkout($user)
    {
        $this->reservations()->create([
            'user_id'=>$user->id,
            'checked_out_at'=>now()
        ]);
    }

    public function checkin($user)
    {
        $reservation=$this->reservations()->where('user_id',$user->id)
                             ->whereNotNull('checked_out_at')
                             ->whereNull('checked_in_at');
        $reservation->update(['checked_in_at'=>now()]);
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

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
