<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }

    public function scopeAvailable($query)
    {
        return $query->whereDoesntHave('lendings', function ($subQuery) {
            $subQuery->whereNull('returned_at');
        });
    }
}
