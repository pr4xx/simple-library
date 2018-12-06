<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $casts = [
        'returned_at' => 'datetime'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
