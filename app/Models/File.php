<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = ['name','type','extension','destination'];


    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
