<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['dob'];

    public function setDobAttributes($dob)
    {
         $this->$attributes['dob'] = Carbon::createFromDate(config('app.date_format'),$dob)->format('dd-mm-yyyy');
    }
}
