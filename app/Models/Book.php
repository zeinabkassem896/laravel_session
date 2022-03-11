<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','description','amazon_url','author_id','file_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
